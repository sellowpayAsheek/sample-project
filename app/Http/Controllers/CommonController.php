<?php

namespace App\Http\Controllers;

use App\Http\Service\CommonService;
use App\Models\CheckRecord;
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

    public function getRecords()
    {
        $records = CheckRecord::all();
        return view('common.record',["records" => $records]);
    }

    public function getCheckList(Request $request,CommonService $service)
    {
        $search_params = [];
        return $service->getCheckList($search_params);
    }

    public function voidCheck($id,CommonService $service)
    {
        return $service->voidACheck($id);
    }

    public function viewCheck($id,CommonService $service)
    {
        return $service->viewACheck($id);
    }

    public function printCheck($id,CommonService $service)
    {
        return $service->printCheck($id);
    }
}
