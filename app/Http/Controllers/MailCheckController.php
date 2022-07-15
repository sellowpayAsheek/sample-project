<?php

namespace App\Http\Controllers;

use App\Http\Service\CommonService;
use Illuminate\Http\Request;

class MailCheckController extends Controller
{
    public function sendMail(Request $request,CommonService $service)
    {
        return $service->sendMail($request->all());
    }
}
