<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\InvoiceMail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    //__checkout page
    public function checkout()
    {
        if (!Auth::check()) {     
             toastr()->error('Login Your Account!');
             return redirect()->back();  
        }
        $content = Cart::content();
        return view('frontend.cart.checkout',compact('content'));

    }

    //__apply coupn__
    public function ApplyCoupon(Request $request)
    {

        $check=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($check) {
            //__coupon exist
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                 session::put('coupon',[
                    'name'=>$check->coupon_code,
                    'discount'=>$check->coupon_amount,
                    'after_discount'=>Cart::subtotal()-$check->coupon_amount
                 ]);
                 toastr()->success('Coupon Applied!', 'success');
                 return redirect()->back();
            }else{
               toastr()->error('Expired Coupon Code!', 'error');
               return redirect()->back();
            }
        }else{
             toastr()->error('Invalid Coupon Code! Try again.', 'error');
             return redirect()->back();
        }

    }

    //__remove coupon__
    public function RemoveCoupon()
    {
         Session::forget('coupon');
         toastr()->success('Coupon removed!', 'success');
         return redirect()->back();
    }



    //__orderplace__
    public function OrderPlace(Request $request)
    {

        if ($request->payment_type=="Hand cash") {
            $order=array();
            $order['user_id']=Auth::id();
            $order['c_name']=$request->c_name;
            $order['c_phone']=$request->c_phone;
            $order['c_country']=$request->c_country;
            $order['c_address']=$request->c_address;
            $order['c_email']=$request->c_email;
            $order['c_zipcode']=$request->c_zipcode;
            $order['c_extra_phone']=$request->c_extra_phone;
            $order['c_city']=$request->c_city;
            if(Session::has('coupon')){
                $order['subtotal']=Cart::subtotal();
                $order['coupon_code']=Session::get('coupon')['name'];
                $order['coupon_discount']=Session::get('coupon')['discount'];
                $order['after_dicount']=Session::get('coupon')['after_discount'];
            }else{
                $order['subtotal']=Cart::subtotal();
                
            }
            $order['total']=Cart::total();
            $order['payment_type']=$request->payment_type;
            $order['tax']=0;
            $order['shipping_charge']=0;
            $order['order_id']=rand(10000,9000000);
            $order['status']=0;
            $order['date']=date('d-m-Y');
            $order['month']=date('F');
            $order['year']=date('Y');

            
            $order_id=DB::table('orders')->insertGetId($order);


            Mail::to($request->c_email)->send(new InvoiceMail($order));

            //order details
            $content=Cart::content();

            $details=array();
            foreach($content as $row){
                $details['order_id']=$order_id;
                $details['product_id']=$row->id;
                $details['product_name']=$row->name;
                $details['color']=$row->options->color;
                $details['size']=$row->options->size;
                $details['quantity']=$row->qty;
                $details['single_price']=$row->price;
                $details['subtotal_price']=$row->price*$row->qty;
                DB::table('orderdetails')->insert($details);
            }

            Cart::destroy();
            if (Session::has('coupon')) {
                  Session::forget('coupon');
            }
            toastr()->success('Successfullt Order Placed!', 'success');
            return redirect()->to('/');

          //__aamarpay payment gateway  
        }elseif($request->payment_type=="Aamarpay"){
            $aamarpay=DB::table('payment_gateway')->first();
            if($aamarpay->store_id==NULL){
                 toastr()->error('Please setting your payment gateway', 'error');
                 return redirect()->back();
            }else{
                if($aamarpay->status==1){
                    $url = "https://secure.aamarpay.com/jsonpost.php"; // live url https://secure.aamarpay.com/request.php
                }else{
                    // $url = 'https://sandbox.aamarpay.com/request.php';
                    $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"
                }
        
                $currency= "BDT";
                $email= $request->c_email;
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$aamarpay->store_id.'",
                    "tran_id": "'.rand(1111111,9999999).'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'.Cart::total().'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$aamarpay->signature_key.'",
                    "desc": "Merchant Registration Payment",
                    "cus_name": "$request->c_name",
                    "cus_email": "$email",
                    "cus_add1": "$request->c_address",
                    "cus_add2": "Mohakhali DOHS",
                    "cus_city": "$request->c_city",
                    "cus_state": "Dhaka",
                    "cus_postcode": "$request->c_zipcode",
                    "cus_country": "$request->c_country",
                    "cus_phone": "$request->c_phone",
                    "type": "json"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));
        
                $response = curl_exec($curl);
        
                curl_close($curl);
                // dd($response);
                
                $responseObj = json_decode($response);
        
                if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {
        
                    $paymentUrl = $responseObj->payment_url;
                    // dd($paymentUrl);
                    return redirect()->away($paymentUrl);
        
                }else{
                    echo $response;
                }
            } 
        }elseif ($request->payment_type=="Paypal"){
            $paypal = DB::table('payment_gateway')->first();
            if($paypal->store_id==NULL){
                 toastr()->error('Please setting your payment gateway', 'error');
                 return redirect()->back();
            }else{
                if($paypal->status==1){
                    $url = "https://secure.aamarpay.com/jsonpost.php"; // live url https://secure.aamarpay.com/request.php
                }else{
                    // $url = 'https://sandbox.aamarpay.com/request.php';
                    $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"
                }
        }
   
    }
}


    //__paymentgateway extra method
    public function success(Request $request){

        $order=array();
        $order['user_id']=Auth::id();
        $order['c_name']=$request->cus_name;
        $order['c_phone']=$request->opt_c;
        $order['c_country']=$request->opt_a;
        $order['c_address']=$request->opt_d;
        $order['c_email']=$request->cus_email;
        $order['c_city']=$request->opt_b;
        if(Session::has('coupon')){
            $order['subtotal']=Cart::subtotal();
            $order['coupon_code']=Session::get('coupon')['name'];
            $order['coupon_discount']=Session::get('coupon')['discount'];
            $order['after_dicount']=Session::get('coupon')['after_discount'];
        }else{
            $order['subtotal']=Cart::subtotal();
            
        }
        $order['total']=Cart::total();
        $order['payment_type']='Aamarpay';
        $order['tax']=0;
        $order['shipping_charge']=0;
        $order['order_id']=rand(10000,900000);
        $order['status']=1;
        $order['date']=date('d-m-Y');
        $order['month']=date('F');
        $order['year']=date('Y');

        $order_id=DB::table('orders')->insertGetId($order);


        Mail::to(Auth::user()->email)->send(new InvoiceMail($order));

        //order details
        $content=Cart::content();

        $details=array();
        foreach($content as $row){
            $details['order_id']=$order_id;
            $details['product_id']=$row->id;
            $details['product_name']=$row->name;
            $details['color']=$row->options->color;
            $details['size']=$row->options->size;
            $details['quantity']=$row->qty;
            $details['single_price']=$row->price;
            $details['subtotal_price']=$row->price*$row->qty;
            DB::table('order_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
              Session::forget('coupon');
        }
        toastr()->success('Successfullt Order Placed!', 'success');
        return redirect()->route('home');
           


        $request_id= $request->mer_txnid;

        //verify the transection using Search Transection API 

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";
        
        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;


    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }

}
