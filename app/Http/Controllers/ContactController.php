<?php

namespace App\Http\Controllers;

use App\Mail\Mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function mail(Request $request)
    {
        Mail::to($request->email)->send(new Mailtrap($request->email, $request->lastname . ' ' . $request->firstname, $request->object, $request->message));
    }
}
