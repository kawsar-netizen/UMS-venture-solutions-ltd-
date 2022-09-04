<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function create()
    {

        return view('email');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
          'email' => 'required|email',
          'subject' => 'required',
          'content' => 'required',
        ]);

        $data = [
          'subject' => $request->subject,
          'email' => $request->email,
          'content' => $request->content
        ];

        try{
            Mail::send('email-template', $data, function($message) use ($data) {
          $message->to($data['email'])
          ->subject($data['subject']);
          
        });
        }catch(Exception $e){

            return $e->getMessage();

        }
        

        return back()->with(['message' => 'Email successfully sent!']);
    }
}
