<?php

namespace App\Http\Controllers;

use App\Http\Service\CommonService;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index(Request $request,CommonService $service)
    {
        $type = $request->get('type');
        if(empty($type)){
            abort(404);
        }

        $bank_account = $service->getBankAccounts();

        return view('common.index',["accounts" => $bank_account]);
    }
}
