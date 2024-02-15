<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //seo page show method
    public function seo()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo',compact('data'));
    }

    //update seo method
    public function seoUpdate(Request $request,$id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;
        DB::table('seos')->where('id',$id)->update($data);
        toastr()->success('SEO Setting Updated!', 'success');
        return redirect()->back();

    }

    //smtp setting page
    public function smtp()
    {
        $data=DB::table('smpts')->first();
        return view('admin.setting.smpt', compact('data'));
    }

    //smtp update
    public function smtpUpdate(Request $request, $id){
        // $data=array();
        // $data['mailer']=$request->mailer;
        // $data['host']=$request->host;
        // $data['port']=$request->port;
        // $data['user_name']=$request->user_name;
        // $data['password']=$request->password;
        // DB::table('smtp')->where('id',$id)->update($data);

        foreach($request->types as $key=>$type){
            $this->updateEnvFile($type, $request[$type]);
        }
        toastr()->success('SMTP Setting Updated!', 'success');
        return redirect()->back();
    }

    public function updateEnvFile($type, $val)
    {
        $path=base_path('.env');
        if (file_exists($path)) {
            $val='"'.trim($val).'"';
            if (strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, 
                        str_replace($type.'="'.env($type).'"', $type.'='.$val,
                            file_get_contents($path)
                        )
                    );
            }else{
                file_put_contents($path,file_get_contents($path).$type.'='.$val);
            }
        }
    }




    //website setting
    public function website()
    {
        $setting=DB::table('websites')->first();
        return view('admin.setting.website',compact('setting'));
    }

    //website setting update
    public function WebsiteUpdate(Request $request,$id)
    {
        $data=array();
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;
        if ($request->logo) {  //jodi new logo die thake
            $photo = $request->logo;
            $manager = new ImageManager(new Driver());
            $photoName = uniqid().'.'.$photo->getClientOriginalExtension();
    
            $photo = $manager->read($request->logo);
            $photo = $photo->resize(320, 120);  //image intervention
            $photo->toPng()->save(base_path('public/backend/files/logo/main/' . $photoName));  //image intervention

            $data['logo']='backend/files/logo/main/'.$photoName;  
        }else{   //jodi new logo na dey
            $data['logo']=$request->old_logo;
        }

        if ($request->favicon) {  //jodi new logo die thake
              $favicon=$request->favicon;
              $manager = new ImageManager(new Driver());
              $favicon_name=uniqid().'.'.$favicon->getClientOriginalExtension();
              $favicon = $manager->read($request->favicon);
              $favicon = $favicon->resize(320, 100);  //image intervention
              $favicon->toPng()->save(base_path('public/backend/files/logo/favicon/' . $favicon_name));  //image intervention
              $data['favicon']='backend/files/logo/favicon/'.$favicon_name;  
        }else{   //jodi new logo na dey
            $data['favicon']=$request->old_favicon;
        }

        DB::table('websites')->where('id',$id)->update($data);
        toastr()->success('Setting Updated!','success');
        return redirect()->back();


    }

    //__payment gateway
    public function PaymentGateway()
    {
        $aamarpay=DB::table('payment_gateway')->first();
        $surjopay=DB::table('payment_gateway')->skip(1)->first();
        $ssl=DB::table('payment_gateway')->skip(2)->first();

        return view('admin.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
    }

    //__aamarpay update
    public function AamarpayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;

        DB::table('payment_gateway')->where('id',$request->id)->update($data);
        toastr()->success('Payment Gateway Update Updated!','success');
        return redirect()->back();
    }

    //__update surjopay
    public function SurjopayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway')->where('id',$request->id)->update($data);
        toastr()->success(' Payment Gateway Update Updated!', 'success');
        return redirect()->back();
    }
    public function SslUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gateway')->where('id',$request->id)->update($data);
        toastr()->success(' Payment Gateway Update Updated!', 'success');
        return redirect()->back();
    }

}
