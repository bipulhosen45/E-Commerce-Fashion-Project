<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\put;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //review store
    public function store(Request $request)
    {
        $validated = $request->validate([
           'rating' => 'required',
           'review' => 'required',
       ]);

        $check=DB::table('reviews')->where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if ($check) {
           toastr()->error('error', 'Already you have a review with this product !');
           return redirect()->back(); 
        }
        //query builder
        $data=array();
        $data['user_id']=Auth::id();
        $data['product_id']=$request->product_id;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date('d-m-Y');
        $data['review_month']=date('F');
        $data['review_year']=date('Y');
        DB::table('reviews')->insert($data);

        toastr()->success('Thank for your review !', 'success');
        return redirect()->back();

    }


    //wqrite a review for website
    public function writeReview()
    {
        return view('user.review_write');
    }

    //store website review
    public function storeWebsiteReview(Request $request)
    {
        $check=DB::table('wbreviews')->where('user_id',Auth::id())->first();
        if ($check) {
            toastr()->error('Review already exist !', 'error');
           return redirect()->back();
        }

        $data=array();
        $data['user_id']=Auth::id();
        $data['name']=$request->name;
        $data['review']=$request->review;
        $data['rating']=$request->rating;
        $data['review_date']=date('d , F Y');
        $data['status'] = 0;
        DB::table('wbreviews')->insert($data);
        toastr()->success('Thank for your review !', 'success');
        return redirect()->back();


    }

    // public function addWishlist($id)
    // {
    //     $check = DB::table('wishlist')->where('user_id', Auth::id())->where('product_id', $id)->first();

    //     if ($check){
    //         toastr()->error('Already have it on your wishlist !', 'error');
    //         return redirect()->back();
    //     }else{
    //         $data = array();
    //         $data['product_id'] = $id;
    //         $data['user_id'] = Auth::id();
    //         $data['date']=date('d , F Y');
    //         DB::table('wishlist')->insert($data);
    //         toastr()->success('Product added on wishlist !', 'success');
    //         return redirect()->back();
    //     }
    // }

}
