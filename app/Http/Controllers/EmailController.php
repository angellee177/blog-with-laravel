<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Title: Mail from Real Programmer',
            'body' => 'Body: This is for testing email using smtp'
        ];
 
        \Mail::send('emails.email', $details, function($message) {
 
            $message->to('angelriapurnamasari17@gmail.com', 'Receiver Name')
 
                    ->subject('Tuts Make Mail');
        });
 
        if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
         }else{
           return 
                  response()->success('Great! Successfully send in your mail');
         }
    }
}
