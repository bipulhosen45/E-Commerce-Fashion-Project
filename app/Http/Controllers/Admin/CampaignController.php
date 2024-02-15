<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
			$data = DB::table('campaigns')->orderBy('id', 'DESC')->get();
			return DataTables::of($data)
				->addIndexColumn()
				->editColumn('status', function ($row) {
					if ($row->status == 1) {
						return '<span class="badge badge-success">Active</span>';
					}else{
						return '<span class="badge badge-danger">Inactive</span>';
					}
				})
				->addColumn('action', function ($row) {
					$actionbtn = '<a href="#" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="' . route('campaign.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete_campaign"><i class="fas fa-trash"></i>
                      	</a>
                      	<a href="'.route('campaign.product', [$row->id]).'" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-plus"></i>
                      	</a>';
					return $actionbtn;
				})
				->rawColumns(['action', 'status'])
				->make(true);
		}

		return view('admin.offer.campaign.index');
    }

    //store campaign
    public function store(Request $request)
    {

        $validated = $request->validate([
           'start_date' => 'required',
           'title' => 'required|unique:campaigns|max:55',
           'image' => 'required',
           'discount' => 'required',
           'status' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');

		$data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;
        $data['month']=date('F');
        $data['year']=date('Y');
		//working with image
		if ($request->file('image')){
			$manager = new ImageManager(new Driver());
			$photo = $request->image;
			$photoName = $slug . '.' . $photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('image'));
			$photo = $photo->resize(1200, 300);  //image interventio
			$photo->toPng()->save(base_path('public/backend/files/campaign/' . $photoName));  //image intervention

			$data['image'] = 'backend/files/campaign/'.$photoName;   // public/files/campaign/plus-point.jpg
		}
		DB::table('campaigns')->insert($data);
		toastr()->success('Campaign Inserted!', 'success');
		return redirect()->back();
    }

    //delete method
    public function destroy($id)
    {
        $data=DB::table('campaigns')->where('id',$id)->first();
        $image=$data->image;
        if (File::exists($image)) {
             unlink($image);
        }
        DB::table('campaigns')->where('id',$id)->delete();
        return response()->json('Coupon deleted!');
    }

    //campaign edit method
    public function edit($id)
    {
      $data=DB::table('campaigns')->where('id',$id)->first();
      return view('admin.offer.campaign.edit',compact('data'));
    }

    //update campaign
    public function update(Request $request)
    {
        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;

        if ($request->image) {
              if (File::exists($request->old_image)) {
                     unlink($request->old_image);
                }
                // $photo = $request->image;
                $manager = new ImageManager(new Driver());
                $photoName = $slug . '.' . $request->image->getClientOriginalExtension();
    
                $photo = $manager->read($request->image);
                $photo = $photo->resize(1200, 300);  //image interventio
                $photo->toPng()->save(base_path('public/backend/files/campaign/'.$photoName));  //image intervention
    
                $data['image'] = 'backend/files/campaign/'.$photoName;   // public/files/brand/plus-point.jpg
              
              DB::table('campaigns')->where('id',$request->id)->update($data); 
              toastr()->success('Campaign Update!', 'success');
              return redirect()->back();
        }else{
          $data['image']=$request->old_image;   
          DB::table('campaigns')->where('id',$request->id)->update($data); 
          toastr()->success('Campaign Update!', 'success');
          return redirect()->back();
        }
    }
  

}
