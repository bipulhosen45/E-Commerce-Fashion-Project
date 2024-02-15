<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ChildcategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data=DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
    		->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();

    		return DataTables::of($data)
    				->addIndexColumn()
    				->addColumn('action', function($row){

    					$actionbtn='
                        <a href="" class="btn btn-info btn-sm mx-1 my-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="#" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#editModal" ><i class="fas fa-edit"></i></a>
                      	<a href="'.route('childcategory.delete',[$row->id]).'" class="btn btn-danger btn-sm delete" id="delete"><i class="fas fa-trash">
                        </i></a>';

                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}
        $category=DB::table('categories')->get();
    	return view('admin.category.childcategory.index',compact('category'));
    }


    public function store(Request $request)
    {
       $cat=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

       $data=array();
       $data['category_id'] = $cat->category_id;
       $data['subcategory_id'] = $request->subcategory_id;
       $data['Childcategory_name'] = $request->Childcategory_name;
       $data['childcategory_slug'] = Str::slug($request->Childcategory_name, '-');

       DB::table('childcategories')->insert($data);
       toastr()->success('Child-Category Inserted!', 'success');
       return redirect()->back();
    }

    public function destroy($id)
    {
        DB::table('childcategories')->where('id',$id)->delete();
        toastr()->success('Child-Category Deleted!', 'success');
        return redirect()->back();

    }

    public function edit($id)
    {
        $category=DB::table('categories')->get();
        $data=DB::table('childcategories')->where('id',$id)->first();
        return view('admin.category.childcategory.edit',compact('category','data'));
    }

    public function update(Request $request)
    {
       $cat=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

       $data=array();
       $data['category_id']=$cat->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_name']=$request->childcategory_name;
       $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');

       DB::table('childcategories')->where('id',$request->id)->update($data);
       toastr()->success('Child-Category Updated!', 'success');
       return redirect()->back();
    }


}
