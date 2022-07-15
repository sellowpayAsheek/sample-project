<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        if(empty($type)){
            abort(404);
        }

        $bank_account[] = [
            "id" => "sadsa" ,
            "name" => "asdasd"
        ];



        return view('common.index',["accounts" => $bank_account]);
    }
}
