<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='backend/files/product';

            $product="";
              $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                    ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id');

                if ($request->category_id) {
                    $query->where('products.category_id',$request->category_id);
                 }

                if ($request->brand_id) {
                    $query->where('products.brand_id',$request->brand_id);
                }

                if ($request->warehouse) {
                    $query->where('products.warehouse',$request->warehouse);
                }

                if ($request->status==1) {
                    $query->where('products.status',1);
                }
                if ($request->status==0) {
                    $query->where('products.status',0);
                }

            $product=$query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                    ->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('thumbnail',function($row) use ($imgurl){
                        return '<img src="'.$imgurl.'/'.$row->thumbnail.'"  height="30" width="30" >';
                    })
                    ->editColumn('featured',function($row){
                        if ($row->featured==1) {
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_featurd"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_featurd"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                        }
                    })
                    ->editColumn('today_deal',function($row){
                        if ($row->today_deal==1) {
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_deal"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_deal"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span> </a>';
                        }
                    })
                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<a href="#" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span> </a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-danger"></i> <span class="badge badge-danger">deactive</span> </a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="'.route('product.edit',[$row->id]).'" class="btn btn-info btn-sm edit"><i class="fas fa-edit"></i></a> 
                        <a href="'.route('product.delete',[$row->id]).'" class="btn btn-danger btn-sm delete" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','category_name','subcategory_name','brand_name','thumbnail','featured','today_deal','status'])
                    ->make(true);       
        }

        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $warehouse =DB::table('warehouses')->get();
        
        return view('admin.product.index',compact('category','brand','warehouse'));
    }

    //product create page
    public function create()
    {
        $category=DB::table('categories')->get();  // Category::all();
        $brand=DB::table('brands')->get();          // Brand::all();
        $pickup_point=DB::table('pickup_point')->get();  // Pickuppoint::all();
        // $warehouse = DB::table('warehouses')->get();  // Warehouse::all();
        $warehouse = DB::table('warehouses')->get();

        return view('admin.product.create',compact('category','brand','pickup_point','warehouse'));
    }

    //product store method
    public function store(Request $request)
    {
       $validated = $request->validate([
           'name' => 'required',
           'code' => 'required|unique:products|max:55',
           'subcategory_id' => 'required',
           'brand_id' => 'required',
           'unit' => 'required',
           'selling_price' => 'required',
           'color' => 'required',
           'description' => 'required',
       ]);

       //subcategory call for category id
       $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
       $slug=Str::slug($request->name, '-');


       $data=array();
       $data['name']=$request->name;
       $data['slug']=Str::slug($request->name, '-');
       $data['code']=$request->code;
       $data['category_id']=$subcategory->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_id']=$request->childcategory_id;
       $data['brand_id']=$request->brand_id;
       $data['pickup_point_id']=$request->pickup_point_id;
       $data['unit']=$request->unit;
       $data['tags']=$request->tags;
       $data['purchase_price']=$request->purchase_price;
       $data['selling_price']=$request->selling_price;
       $data['discount_price']=$request->discount_price;
       $data['warehouse']=$request->warehouse;
       $data['stock_quantity']=$request->stock_quantity;
       $data['color']=$request->color;
       $data['size']=$request->size;
       $data['description']=$request->description;
       $data['video']=$request->video;
       $data['featured']=$request->featured;
       $data['today_deal']=$request->today_deal;
       $data['product_slider']=$request->product_slider;
       $data['status']=$request->status;
       $data['trendy']=$request->trendy;
       $data['admin_id']=Auth::id();
       $data['date']=date('d-m-Y');
       $data['month']=date('F');
       $data['year']=date('Y');
       //single thumbnail
       if ($request->thumbnail) {

            $thumbnail=$request->thumbnail;
            $manager = new ImageManager(new Driver());
            $photoname= $slug.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail = $manager->read($request->thumbnail);
            $thumbnail = $thumbnail->resize(600, 600);  //image intervention
            $thumbnail->toPng()->save(base_path('public/backend/files/product/'.$photoname));  //image intervention

            $data['thumbnail']=$photoname;   // public/files/product/plus-point.jpg
       }
       //multiple images
       $images = array();
       if($request->hasFile('images')){
           foreach ($request->file('images') as $key => $image) {

            // $image = $request->image;
            $manager = new ImageManager(new Driver());
            $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image = $manager->read($image);
            $image = $image->resize(600, 600);  //image intervention
            $image->toPng()->save(base_path('public/backend/files/product/'.$imageName));  //image intervention
            array_push($images, $imageName);
           }
           $data['images'] = json_encode($images);
       }
       DB::table('products')->insert($data);
       toastr()->success('Product Inserted!','success');
       return redirect()->back();

    }

    //edit method
    public function edit($id)
    {
        $product= DB::table('products')->where('id',$id)->first();
        //$product=Product::findorfail($id);
        $category=Category::all();
        $brand=Brand::all();
        $warehouse=DB::table('warehouses')->get();
        $pickup_point=DB::table('pickup_point')->get();
         //childcategory get_
        $childcategory=DB::table('childcategories')->where('category_id',$product->category_id)->get();
        // dd($childcategory);
        return view('admin.product.edit',compact('product','category','brand','warehouse','pickup_point','childcategory'));
    }

    //__update product__//
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required',
       ]);

       //subcategory call for category id
       $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
       $slug=Str::slug($request->name, '-');


       $data=array();
       $data['name']=$request->name;
       $data['slug']=Str::slug($request->name, '-');
       $data['code']= $request->code;
       $data['category_id']=$subcategory->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_id']=$request->childcategory_id;
       $data['brand_id']=$request->brand_id;
       $data['pickup_point_id']=$request->pickup_point_id;
       $data['unit']=$request->unit;
       $data['tags']=$request->tags;
       $data['purchase_price']=$request->purchase_price;
       $data['selling_price']=$request->selling_price;
       $data['discount_price']=$request->discount_price;
       $data['warehouse']=$request->warehouse;
       $data['stock_quantity']=$request->stock_quantity;
       $data['color']=$request->color;
       $data['size']=$request->size;
       $data['description']=$request->description;
       $data['video']=$request->video;
       $data['featured']=$request->featured;
       $data['today_deal']=$request->today_deal;
       $data['product_slider']=$request->product_slider;
       $data['status']=$request->status;
       $data['trendy']=$request->trendy;

       //__old thumbnail ase kina__ jodi thake new thumbnail insert korte hobe
       $thumbnail = $request->file('thumbnail');
        if($thumbnail) {
           
            $thumbnail=$request->thumbnail;
            $manager = new ImageManager(new Driver());
            $photoname= $slug.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail = $manager->read($request->thumbnail);
            $thumbnail = $thumbnail->resize(600, 600);  //image intervention
            $thumbnail->toPng()->save(base_path('public/backend/files/product/'.$photoname));  //image intervention

            $data['thumbnail']=$photoname;   // public/files/product/plus-point.jpg 
        }

       //__multiple image update__//

        $old_images = $request->has('old_images');
        if($old_images){
            $images = $request->old_images;
            $data['images'] = json_encode($images);
        }else{
            $images = array();
            $data['images'] = json_encode($images); 
        }

        if($request->hasFile('images')){
            foreach ($request->file('images') as $key => $image) {
                $manager = new ImageManager(new Driver());
                $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $image = $manager->read($image);
                $image = $image->resize(600, 600);  //image intervention
                $image->toPng()->save(base_path('public/backend/files/product/'.$imageName));  //image intervention
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }



       DB::table('products')->where('id',$request->id)->update($data);
       toastr()->success('Product Update!','success');
       return redirect()->route('product.index');
    }

    //not featured
    public function notfeatured($id)
    {
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        return response()->json('Product Not Featured');
    }

    //active featured
    public function activefeatured($id)
    {
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        return response()->json('Product Featured Activated');
    }

    //not Deal
    public function notdeal($id)
    {
        DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
        return response()->json('Product Not Today deal');
    }

    //active Deal
    public function activedeal($id)
    {
        DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
        return response()->json('Product today deal Activated');
    }

    //not status
    public function notstatus($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json('Product Deactive');
    }

    //active staus
    public function activestatus($id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('Product Activated');
    }

    //product delete
    public function destroy($id)
    {

        $product=DB::table('products')->where('id',$id)->first();  //product data get
        if (File::exists('backend/files/product/'.$product->thumbnail)) {
              FIle::delete('backend/files/product/'.$product->thumbnail);
        }

        $images=json_decode($product->images,true);
        if (isset($images)) {
             foreach($images as $key => $image){
                if (File::exists('backend/files/product/'.$image)) {
                    FIle::delete('backend/files/product/'.$image);
                }
             }
        }

        DB::table('products')->where('id',$id)->delete();
        toastr()->success('Product Deleted!', 'success');
       return redirect()->back();
    }

    




}
