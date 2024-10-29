<?php

namespace App\Http\Controllers;

use App\Mail\welcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Mailcontroller extends Controller
{
    function sendEmail(){
        $to = "sunasaraahemadabbas19@gmail.com";
        $msg = "this is dummy text";
        $subject = "Code with laravel";
        Mail::to($to)->send(new welcomeEmail($msg,$subject));

        return "success";
    }
}
