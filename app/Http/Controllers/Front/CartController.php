<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //add to cart method
    public function AddToCartQV(Request $request)
    {
        //3 way to retrive data from database

        // $product=DB::table('products')->where('id',$request->id)->first();
        $product=Product::where('id',$request->id)->first();  

        // $product=Product::find($request->id);
        Cart::add([
            'id'     => $product->id,
            'name'   => $product->name,
            'qty'    => $request->qty,
            'price'  => $request->price,
            'weight' => '1',
            'options'=> ['size'=>$request->size , 'color'=> $request->color ,'thumbnail'=>$product->thumbnail],

        ]);
        return response()->json('Product added on cart!');
        // return response()->json("product added on cart!");
        // return $product;
    }

    //all cart
    public function AllCart()
    {
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        return response()->json($data);
    }


    //wishlist
    public function addWishlist($id)
    {

        if(Auth::check()){
            $check=DB::table('wishlist')->where('product_id',$id)->where('user_id',Auth::id())->first();
               if ($check) {
                     toastr()->error('Already have it on your wishlist !', 'error');
                     return redirect()->back(); 
               }else{
                    $data=array();
                    $data['product_id']=$id;
                    $data['user_id']=Auth::id();
                    $data['date']=date('d , F Y');
                    DB::table('wishlist')->insert($data);
                    toastr()->success('Product added on wishlist!', 'success');
                    return redirect()->back(); 
               }
        }

        toastr()->success('Login Your Account!', 'error');
        return redirect()->back();  
    }


    public function MyCart()
    {
        $content = Cart::content();
        // return response()->json($content);
        return view('frontend.cart.cart',compact('content'));
    }

    public function RemoveProdut($rowId)
    {
        Cart::remove($rowId);
        return response()->json('Success!');
    }

    public function UpdateQty($rowId, $qty)
    {
        // Cart::update($rowId, ['qty' => $qty]);
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json('Successfully Updated!');
    }

    public function UpdateColor($rowId,$color)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;
        Cart::update($rowId, ['options'  => ['color' => $color , 'thumbnail'=>$thumbnail ,'size'=>$size]]);
        return response()->json('Successfully Updated!');
    }

    public function UpdateSize($rowId,$size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId, ['options'  => ['size' => $size , 'thumbnail'=>$thumbnail ,'color'=>$color]]);
        return response()->json('Successfully Updated!');
    }

    public function EmptyCart()
    {
        Cart::destroy();
        toastr()->success('Cart item clear', 'success');
        return redirect()->to('/'); 
    }
//wistlist page
    public function wishlist()
    {
        if (Auth::check()) {
               $wishlist = DB::table('wishlist')->leftJoin('products','wishlist.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlist.*')->where('wishlist.user_id',Auth::id())->get();

               return view('frontend.cart.wishlist',compact('wishlist'));
        }
        toastr()->error('At first login your account', 'error');
        return redirect()->back();
    }

    public function Clearwishlist()
    {
        DB::table('wishlist')->where('user_id', Auth::id())->delete();
        toastr()->success('Wishlist Clear', 'success');
        return redirect()->back();
    }

    public function WishlistProductdelete($id)
    {
        DB::table('wishlist')->where('id',$id)->delete();
        toastr()->success('Successfully Deleted!', 'success');
        return redirect()->back();
    }

}
