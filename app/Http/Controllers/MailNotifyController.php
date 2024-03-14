<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Mail;

class MailNotifyController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $email = $request->email;

        // You can add ststic email for ex: Mail::to('muh@mail.com')...
        Mail::to($email)->send(new MailNotify($name, $email));
    }
}
