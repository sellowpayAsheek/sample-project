<?php

namespace App\Http\Controllers;

use App\Http\Service\CommonService;
use Illuminate\Http\Request;

class EmailCheckController extends Controller
{
    public function sendEmail(Request $request,CommonService $service)
    {
        return $service->sendEMail($request->all());
    }
}
