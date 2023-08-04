<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function Contact(){
        return view('frontend/home_all/contact');
    }

    public function SendContact(Request $request){


            Contact::insert([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'phone' => $request->phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
                
                

            ]); 
            $notification = array(
            'message' => 'Your mesage send successfully A author will contact you immedietly', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        

    }

    //admin getting message
    public function getMessage(){
        $get_msg = Contact::latest()->get();
        return view('admins.home.contact',compact('get_msg'));
    }

    public function MessageDetails($id){
        $get_details_message = Contact::findOrFail($id);
        return view('admins.home.message_details',compact('get_details_message'));
    }

    }
    //

