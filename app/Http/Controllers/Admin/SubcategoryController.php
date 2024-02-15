<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //index method for read data
    public function index()
    {
    	    //Query Builder with one to one join
    	// $data=DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
    	//       ->select('subcategories.*','categories.category_name')->get();

    	     //Eloquent ORM
    	$data=Subcategory::all();
    	$category=Category::all();  
    	//$category=DB::table('categories')->get();  
    	 return view('admin.category.subcategory.index',compact('data','category'));     
    }


    //store method
    public function store(Request $request)
    {
    	$validated = $request->validate([
           'subcategory_name' => 'required|max:55',
       ]);

    	// $data=array();
    	// $data['category_id']=$request->category_id;
    	// $data['subcategory_name']=$request->subcategory_name;
    	// $data['subcat_slug']=Str::slug($request->subcategory_name, '-');

    	// DB::table('subcategories')->insert($data);

    	//Eloquent ORM
    	Subcategory::insert([
    		'category_id'=> $request->category_id,
    		'subcategory_name'=> $request->subcategory_name,
    		'subcategory_slug'=> Str::slug($request->subcategory_name, '-')
    	]);


    	toastr()->success('Subcategory Inserted!', 'success');
    	return redirect()->back();


    }

    //destroy subcategory
    public function destroy($id)
    {
    	// DB::table('subcategories')->where('id',$id)->delete();    //query builder

    	$subcat=Subcategory::find($id);
    	$subcat->delete();

    	toastr()->success('Subategory Deleted!', 'success');
    	return redirect()->back();

    }


    //edit subcategory
    public function edit($id)
    {
    	    // Eloquent ORM
    	// $data=Subcategory::find($id);
    	// $category=Category::all();
    	    //Query Builder
    	$data=Subcategory::find($id);
    	$category=DB::table('categories')->get();

    	return view('admin.category.subcategory.edit',compact('data','category'));
    }

    //update method
    public function update(Request $request)
    {
       //Eloquent ORM
       $subcategory=Subcategory::where('id',$request->id)->first();
       $subcategory->update([
       		'category_id'=> $request->category_id,
    		'subcategory_name'=> $request->subcategory_name,
    		'subcategory_slug'=> Str::slug($request->subcategory_name, '-')
       ]);

       //QueryBuilder

    	// $data=array();
    	// $data['category_id']=$request->category_id;
    	// $data['subcategory_name']=$request->subcategory_name;
    	// $data['subcat_slug']=Str::slug($request->subcategory_name, '-');
    	// DB::table('subcategories')->where('id',$request->id)->update($data);

		toastr()->success('Subategory Updated!', 'success');
    	return redirect()->back();
    }



}
