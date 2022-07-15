<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailCheckController extends Controller
{
    public function sendMail(Request $request)
    {
        dd($request->all());
    }
}
