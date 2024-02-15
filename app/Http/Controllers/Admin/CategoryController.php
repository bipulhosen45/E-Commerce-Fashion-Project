<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all category showing method
    public function index()
    {
    	// $data=DB::table('categories')->get();  //query builder
    	$data=Category::all();	//eloquent ORM
    	return view('admin.category.category.index',compact('data'));
    	
    }

    //store method
    public function store(Request $request)
    {
    	$validated = $request->validate([
           'category_name' => 'required|unique:categories|max:55',
           'icon' => 'required',
       ]);

    	//query builder
    	// $data=array();
    	// $data['category_name']=$request->category_name;
    	// $data['category_slug']=Str::slug($request->category_name, '-');
    	// DB::table('categories')->insert($data);

          $slug=Str::slug($request->category_name, '-');
          if($request->file('icon'))
          $manager = new ImageManager(new Driver());
          $photo=$request->icon;
          $iconName = $slug.'.'.$photo->getClientOriginalExtension();

          $photo = $manager->read($request->file('icon'));
          $photo = $photo->resize(600,600);  //image interventio


          $photo->toPng()->save(base_path('public/backend/files/category/'.$iconName));
          // $saveUrl = 'files/category/'.$iconName;
        	//Eloquent ORM
        	Category::insert([
        		'category_name' => $request->category_name,
        		'category_slug' => $slug,
            'home_page'     => $request->home_page,
            'icon'          => $iconName,
        	]);

          toastr()->success('Category Inserted!', 'success');
    	  return redirect()->back();
    }

    //edit method
    public function edit($id)
    {
    	// $data=DB::table('categories')->where('id',$id)->first();
    	  $data = Category::findorfail($id);
        return view('admin.category.category.edit',compact('data'));
    	//return response()->json($data);
    }

    //update method
    public function update(Request $request)
    {
      //Query Builder update
    	// $data=array();
    	// $data['category_name']=$request->category_name;
    	// $data['category_slug']=Str::slug($request->category_name, '-');
    	// DB::table('categories')->where('id',$request->id)->update($data);

     

      $slug=Str::slug($request->category_name, '-');
      $data=array();
      $data['category_name']=$request->category_name;
      $data['category_slug']=$slug;
      $data['home_page']=$request->home_page;
      if ($request->icon) {
            if (File::exists($request->old_icon)) {
                   unlink($request->old_icon);
              }
            $photo=$request->icon;
            $manager = new ImageManager(new Driver());
            $photo=$request->icon;
            $iconName = $slug.'.'.$photo->getClientOriginalExtension();
      
            $photo = $manager->read($request->icon);
            $photo = $photo->resize(600,600);  //image interventio
            $photo->toPng()->save(base_path('public/backend/files/category/'.$iconName));

            $data['icon']= $iconName; 

            DB::table('categories')->where('id',$request->id)->update($data); 
            toastr()->success('Category Updated!', 'success');
            return redirect()->back();
      }else{
        $data['icon']=$request->old_icon;   
        DB::table('categories')->where('id',$request->id)->update($data); 
        toastr()->success('Category Updated!', 'success');
        return redirect()->back();
      }
    }


    //delete category method
    public function destroy($id)
    {
    	//query builder
    	   //DB::table('categories')->where('id',$id)->delete();
    	//eleqoent ORM
     
    	// $category=Category::find($id);
    	// $category->delete();

      //another method=====================================
      // $data = Category::find($id);
      // if(file_exists('backend/files/category/'.$data->icon)){
      //     unlink('backend/files/category/'.$data->icon);
      // };
      // $data->delete();
      //=====================================================

      $data = DB::table('categories')->where('id', $id)->first();
		  $photo = $data->icon;
      $path = 'backend/files/category/'.$photo;

      if (File::exists($path)) {
        unlink($path);
      }
      DB::table('categories')->where('id', $id)->delete();

      toastr()->success('Category Deleted!', 'success');
    	return redirect()->back();
    }

    //get child category
    public function GetChildCategory($id)  //subcategory_id
    {
        $data=DB::table('childcategories')->where('subcategory_id',$id)->get();
        return response()->json($data);
    }


    
}
