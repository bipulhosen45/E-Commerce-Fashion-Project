<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact= DB::table('contacts')->get();
        return view('admin.contact.index', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = DB::table('contacts')->where('id', $id)->first();
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('contacts')->where('id', $id)->delete();
        DB::table('replies')->where('id', $id)->delete();
        toastr()->success('Contact Deleted!', 'Success');
        return redirect()->back();
    }


    public function ReplyContact(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['contact_id']=$request->contact_id;
        $data['c_email']=$request->c_email;
        $data['message']=$request->message;
        $data['reply_date']= date('Y-m-d');
        
        Mail::to($request->c_email)->send(new ContactReplyMail($data));

        DB::table('replies')->insert($data);
        DB::table('contacts')->where('id',$request->contact_id)->update(['status'=>1]);

        toastr()->success( 'Replied Done!', 'success');
        return redirect()->back();
    }
}
