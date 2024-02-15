<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brand;
use App\Models\Pickuppoint;
use App\Models\Campaign;
use App\Models\Warehouse;
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','subcategory_id','childcategory_id','brand_id','pickup_point_id','name','code','unit','tags','color','size','video','purchase_price','selling_price','discount_price','stock_quantity','warehouse','description','thumbnail','images','featured','today_deal','product_slider','product_views', 'status','trendy','admin_id', 'flash_deal_id','cash_on_delivery'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function childcategory(){
        return $this->belongsTo(Childcategory::class,'childcategory_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickuppoint(){
        return $this->belongsTo(Pickuppoint::class,'pickup_point_id');
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class,'today_deal');
    }
    // public function warehouse(){
    //     return $this->belongsTo(Warehouse::class);
    // }


}
