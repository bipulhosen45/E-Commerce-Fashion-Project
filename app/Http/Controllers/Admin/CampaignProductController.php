<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($campaign_id)
    {

        $products = DB::table('products')->leftJoin('categories','products.category_id','categories.id')
        ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
        ->leftJoin('brands','products.brand_id','brands.id')
        ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
        ->where('products.status','1')
        ->get();

        return view('admin.offer.campaign_product.index',compact('products', 'campaign_id'));
    }

    public function ProductAddToCampaign($id,$campaign_id)
    {
        $campaign=DB::table('campaigns')->where('id',$campaign_id)->first();
        $product=DB::table('products')->where('id',$id)->first();
 
        $discount_amount=$product->selling_price/100*$campaign->discount;
        $discount_price=$product->selling_price-$discount_amount;
 
        $data=array();
        $data['product_id']=$id;
        $data['campaign_id']=$campaign_id;
        $data['price']=$discount_price;
        DB::table('campaign_product')->insert($data);
        toastr()->success('Product added to campaign!', 'success');
        return redirect()->back();
    }

     //__product list__//
     public function ProductListCampaign($campaign_id)
     {
         $products=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                     ->select('products.name','products.code','products.thumbnail','campaign_product.*')
                     ->where('campaign_product.campaign_id',$campaign_id)
                     ->get();
         $campaign=DB::table('campaigns')->where('id',$campaign_id)->first();            
         return view('admin.offer.campaign_product.campaign_product_list',compact('products','campaign'));
     }

       //__product rmove from campaign__//
    public function RemoveProduct($id)
    {
        DB::table('campaign_product')->where('id',$id)->delete();
        toastr()->success('Product remove from campaign!', 'success');
        return redirect()->back();
    }
}
