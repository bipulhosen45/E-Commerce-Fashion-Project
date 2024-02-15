<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       if ($request->ajax()) {
            $data=DB::table('warehouses')->latest()->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-warning btn-sm edit" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#editModal" ><i class="fas fa-edit"></i></a>
                        <a href="'.route('warehouse.delete',[$row->id]).'" class="btn btn-danger btn-sm delete" id="delete"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action'])
                    ->make(true);       
        }
        $data= DB::table('warehouses')->get();
        return view('admin.category.warehouse.index', compact('data'));
    }

    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
           'warehouse_name' => 'required|unique:warehouses',
        ]);

        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;
        DB::table('warehouses')->insert($data);
        toastr()->success('Warehouse Inserted!' , 'success');
        return redirect()->back();
    }

    //delete warehouse
    public function destroy($id)
    {
        DB::table('warehouses')->where('id',$id)->delete();
        toastr()->success('Warehouse Deleted!' , 'success');
        return redirect()->back();

    }

    public function edit($id)
    {
        $data=DB::table('warehouses')->where('id',$id)->first();
        return view('admin.category.warehouse.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $data=array();
        $data['warehouse_name']=$request->warehouse_name;
        $data['warehouse_address']=$request->warehouse_address;
        $data['warehouse_phone']=$request->warehouse_phone;
        DB::table('warehouses')->where('id',$request->id)->update($data);
        toastr()->success('Warehouse Updated!' , 'success');
        return redirect()->route('warehouse.index');
    }
}
