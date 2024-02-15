<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = DB::table('brands')->get();
			return DataTables::of($data)
				->addIndexColumn()
				->editColumn('front_page', function ($row) {
					if ($row->front_page == 1) {
						return '<span class="badge badge-success">Yes</span>';
					}else{
						return '<span class="badge badge-danger">No</span>';
					}
				})
				->addColumn('action', function ($row) {
					$actionbtn = '<a href="#" class="btn btn-warning btn-sm edit" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="' . route('brand.delete', [$row->id]) . '" class="btn btn-danger btn-sm delete" id="delete"><i class="fas fa-trash"></i>
                      	</a>';
					return $actionbtn;
				})
				->rawColumns(['action', 'front_page'])
				->make(true);
		}

		return view('admin.category.brand.index');
	}

	//store method
	public function store(Request $request)
	{
		$validated = $request->validate([
			'brand_name' => 'required|unique:brands|max:55',
		]);

		$slug = Str::slug($request->brand_name, '-');

		$data = array();
		$data['brand_name'] = $request->brand_name;
		$data['brand_slug'] = Str::slug($request->brand_name, '-');
		$data['front_page'] = $request->front_page;
		//working with image
		if ($request->file('brand_logo')){
			$manager = new ImageManager(new Driver());
			$photo = $request->brand_logo;
			$photoName = $slug . '.' . $photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('brand_logo'));
			$photo = $photo->resize(600, 300);  //image interventio
			$photo->toPng()->save(base_path('public/backend/files/brand/' . $photoName));  //image intervention

			$data['brand_logo'] = 'backend/files/brand/'.$photoName;   // public/files/brand/plus-point.jpg
		}
		DB::table('brands')->insert($data);
		toastr()->success('Brand Inserted!', 'success');
		return redirect()->back();
	}

	public function destroy($id)
	{
		$data = DB::table('brands')->where('id', $id)->first();
		$photo = $data->brand_logo;
		$path = 'backend/files/brand/'.$photo;

		if (File::exists($path)) {
			unlink($path);
		}
		DB::table('brands')->where('id', $id)->delete();
		toastr()->success('Brand Deleted!', 'success');
		return redirect()->back();
	}

	public function edit($id)
	{
		$data = DB::table('brands')->where('id', $id)->first();
		return view('admin.category.brand.edit', compact('data'));
	}

	public function update(Request $request)
	{
		$slug = Str::slug($request->brand_name, '-');
		$data = array();
		$data['brand_name'] = $request->brand_name;
		$data['brand_slug'] = Str::slug($request->brand_name, '-');
		$data['front_page'] = $request->front_page;
		if ($request->brand_logo) {
			if (File::exists($request->old_logo)) {
				unlink($request->old_logo);
			}
			$photo = $request->brand_logo;
			$manager = new ImageManager(new Driver());
			$photoName = $slug . '.' . $photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('brand_logo'));
			$photo = $photo->resize(600, 300);  //image interventio
			$photo->toPng()->save(base_path('public/backend/files/brand/' . $photoName));  //image intervention

			$data['brand_logo'] = '/backend/files/brand/'.$photoName;
			DB::table('brands')->where('id', $request->id)->update($data);
			$notification = array('messege' => 'Brand Update!', 'alert-type' => 'success');
			return redirect()->back()->with($notification);
		} else {
			$data['brand_logo'] = $request->old_logo;
			DB::table('brands')->where('id', $request->id)->update($data);
			toastr()->success('Brand Updated!', 'success');
			return redirect()->back();
		}
	}
}
