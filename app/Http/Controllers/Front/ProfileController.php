<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customerSetting()
    {
        $data = DB::table('shippings')->first();
        return view('user.setting', compact('data'));
    }
    public function shippingupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'shipping_name' => 'required',
            'shipping_phone' => 'required',
            'shipping_address' => 'required',
            'shipping_country' => 'required',
            'shipping_city' => 'required',
         ]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_country'] = $request->shipping_country;
        $data['shipping_city'] = $request->shipping_city;
        $data['shipping_zipcode'] = $request->shipping_zipcode;

        DB::table('shippings')->where('id',$id)->update($data);
        toastr()->success('Shipping address successful!', 'success');
        return redirect()->back();
    }

    public function customerPasswordChange(Request $request)
    {
       $validated = $request->validate([
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
        ]);

        $current_password=Auth::user()->password;  //login user password get


        $oldpass=$request->old_password;  //oldpassword get from input field
        $new_password=$request->password;  // newpassword get for new password
        if (Hash::check($oldpass,$current_password)) {  //checking oldpassword and currentuser password same or not
               $user=User::findorfail(Auth::id());    //current user data get
               $user->password=Hash::make($new_password); //current user password hasing
               $user->save();  //finally save the password
               Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
               toastr()->success('Your Password Changed!', 'success');
               return redirect()->to('/');
        }else{
            toastr()->error('Old Password Not Matched!', 'error');
            return redirect()->back();
        }
    }


    public function Myorder()
    {
       $orders=DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
       return view('user.my_order',compact('orders'));
    }

    //ticekt
    public function OpenTicket()
    {
        $ticket=DB::table('tickets')->where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        return view('user.ticket',compact('ticket'));
    }

    //new ticket
    public function NewTicket()
    {
       return view('user.new_ticket');
    }

    //store ticket
    public function StoreTicket(Request $request)
    {
        $validated = $request->validate([
           'subject' => 'required',
        ]);

        $data=array();
        $data['subject']=$request->subject;
        $data['service']=$request->service;
        $data['priority']=$request->priority;
        $data['message']=$request->message;
        $data['user_id']=Auth::id();
        $data['status']=0;
        $data['date']=date('Y-m-d');

        if ($request->file('image')){
			$manager = new ImageManager(new Driver());
			$photo = $request->image;
			$photoName = uniqid().'.'.$photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('image'));
			$photo = $photo->resize(600,350);  //image interventio
			$photo->toPng()->save(base_path('public/backend/files/ticket/' . $photoName));  //image intervention

			$data['image'] = 'backend/files/ticket/'.$photoName;   // public/files/brand/plus-point.jpg
		}
        
        DB::table('tickets')->insert($data);
        toastr()->success('Ticket Inserted!', 'success');
        return redirect()->route('open.ticket');
    }

    //__ticket show
    public function ShowTicket($id)
    {
        $ticket=DB::table('tickets')->where('id',$id)->first();
        return view('user.show_ticket',compact('ticket'));
    }


    //__reply ticket
    public function ReplyTicket(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['user_id']=Auth::id();
        $data['reply_date']=date('Y-m-d');

        if ($request->file('image')){
			$manager = new ImageManager(new Driver());
			$photo = $request->image;
			$photoName = uniqid().'.'.$photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('image'));
			$photo = $photo->resize(600,350);  //image interventio
			$photo->toPng()->save(base_path('public/backend/files/ticket/' . $photoName));  //image intervention

			$data['image'] = 'backend/files/ticket/'.$photoName;   // public/files/brand/plus-point.jpg
		}
        
        DB::table('replies')->insert($data);

        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>0]);

        toastr()->success( 'Replied Done!', 'success');
        return redirect()->back();
    }

     //__cuistoomer oder details
     public function ViewOrder($id)
     {
         $order = DB::table('orders')->where('id',$id)->first();
         //$order=Order::findorfail($id);
         $order_details=DB::table('orderdetails')->where('order_id',$id)->get();
 
         return view('user.order_details',compact('order','order_details'));
     }

}
