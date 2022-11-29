<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class Mail_controller extends Controller

//users is an arrey
//pass all templet variables inside $body
{
    public function send_mail(Request $req){ 
        $users = $req->users;   
        $subject = $req->subject; 
        Mail::send($req->templet,$req->body,function($messages) use ($users,$subject){
            $messages->to($users);
            $messages->subject($subject);
        });
        return 1;
    }
}


