<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\ShareFacade;

class IndexController extends Controller
{
    //root page
    public function index()
    {
        $category =DB::table('categories')->orderBy('category_name','ASC')->get();
        $brand = DB::table('brands')->where('front_page',1)->limit(24)->get();
        $bannerproduct = Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $todaydeal = Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->limit(6)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $review=DB::table('wbreviews')->where('status',1)->orderBy('id','DESC')->limit(12)->get();
        //homepage category
        $home_category=DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        $campaign = DB::table('campaigns')->where('status',1)->orderBy('id','DESC')->first();

        return view('frontend.index', compact('category','bannerproduct','featured','popular_product','trendy_product','home_category','brand','random_product','todaydeal', 'review', 'campaign'));
    }

    //singleproduct page calling method
    public function ProductDetails($slug)
    {
        $product=Product::where('slug',$slug)->first();
                 Product::where('slug',$slug)->increment('product_views');
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();

        $shareButton1 = ShareFacade::page('http://jorenvanhocht.be', 'Share title')
        ->facebook()
        ->twitter()
        ->linkedin('Extra linkedin summary can be passed here')
        ->whatsapp();
        

        return view('frontend.product.product_details',compact('product','related_product','review', 'shareButton1'));
    }

    //product quick view
    public function ProductQuickView($id)
    {
        $product = Product::where('id',$id)->first();
        return view('frontend.product.quick_view',compact('product'));
    }


    //categorywise product page
    public function categorywiseProduct($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brand = DB::table('brands')->get();
        $products = DB::table('products')->where('category_id',$id)->paginate(60);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.category_products', compact('subcategory','brand','products','random_product','category'));

    }

    //subcategorywise product
    public function subcategorywiseProduct($id)
    {
        $subcategory=DB::table('subcategories')->where('id',$id)->first();
        $childcategories=DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('subcategory_id',$id)->paginate(60);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.subcategory_products',compact('childcategories','brand','products','random_product','subcategory'));
    }

    //childcategory product
    public function childcategorywiseProduct($id)
    {
        $childcategory= DB::table('childcategories')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('childcategory_id',$id)->paginate(60);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.childcategory_products',compact('categories','brand','products','random_product','childcategory'));
    }

    //brandwise product
    public function brandwiseProduct($id)
    {
        $brand=DB::table('brands')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brands=DB::table('brands')->get();
        $products=DB::table('products')->where('brand_id',$id)->paginate(60);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.brandwise_products',compact('categories','brands','products','random_product','brand'));
    }

    //page view method====================================
    public function ViewPage($page_slug)
    {
        $page = DB::table('pages')->where('page_slug',$page_slug)->first();
        return view('frontend.page',compact('page'));
    }

    //store newsletter
    public function newsletterstore(Request $request)
    {
        $email=$request->email;
        $check=DB::table('newsletters')->where('email',$email)->first();
        if ($check) {
            return response()->json('Email Already Exist!');
        }else{
              $data=array();
              $data['email']=$request->email;
              DB::table('newsletters')->insert($data);
              return response()->json('Thanks for subscribe us!');  
        }

       

    }


    //__order tracking page
    public function OrderTracking()
    {
        return view('frontend.order_tracking');
    }
   
   
    //__check orer
    public function CheckOrder(Request $request)
    {
        $check=DB::table('orders')->where('order_id',$request->order_id)->first();
        if ($check) {
            $order = DB::table('orders')->where('order_id',$request->order_id)->first();
            $order_details = DB::table('orderdetails')->where('order_id',$order->id)->get();
            return view('frontend.order_details',compact('order','order_details'));
        }else{
            toastr()->error('Invalid OrderID! Try again.', 'error');
            return redirect()->back();
        }
    }

    //constact page
    public function Contact()
    {
        return view('frontend.contact');
    }
    //constact store
    public function ContactStore(Request $request)
    {
        $data=array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['message'] = $request->message;

        DB::table('contacts')->insert($data);
        toastr()->success('Contact Inserted!', 'Success');
        return redirect()->back();
    }

    //__blog page
    public function Blog()
    {
        $blog = DB::table('blogs')->where('status', 1)->limit(6)->get();
        return view('frontend.blog', compact('blog'));
    }

    public function BlogDetails($slug)
    {
        // $blog = DB::table('blogs')->where('slug', $slug)
        //         ->leftJoin('blog_categories','blogs.blog_category_id','blog_categories.id')
        //         ->leftJoin('users','blogs.user_id','users.id')
    	//         ->select('blogs.*','blog_categories.category_name', 'users.name')->first();
        // $related_blog=DB::table('blogs')->where('user_id', $blog->user_id)->orderBy('id','DESC')->take(3)->get();

        // $review=Review::where('blog_id',$blog->id)->orderBy('id','DESC')->take(6)->get();

        $blog = Blog::where('slug', $slug)->first();
        return view('frontend.blog_details',compact('blog'));
    }

    //__campaign products__//
    public function CampaignProduct($id)
    {
        $products=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                    ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                    ->where('campaign_product.campaign_id',$id)
                    ->paginate(32);          
        return view('frontend.campaign.product_list',compact('products'));
    }

    //__campaign product details__//
    public function CampaignProductDetails($slug)
    {
        $product = Product::where('slug',$slug)->first();
                 Product::where('slug',$slug)->increment('product_views');
        $product_price = DB::table('campaign_product')->where('product_id',$product->id)->first();         
        $related_product = DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                    ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                    ->inRandomOrder(12)->get();
        $review = Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();
        return view('frontend.campaign.product_details',compact('product','related_product','review','product_price'));

    }


}
