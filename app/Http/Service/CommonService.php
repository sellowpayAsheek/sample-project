<?php

namespace App\Http\Service;

use App\Models\CheckRecord;
use Echeck\Echeck;
use Exception;

class CommonService
{
    protected $echeck ;

    public function __construct()
    {
        try{
            Echeck::setToken("68e3f0GqQLWoGqf0bNMRPr8gLwnPR6btOZx2t6UQdhnPHizDwjYztrKGeG23");
            // Echeck::setToken('EiZNSqeKYpMcIZbEn3KFLDyNGKtMa7b6orEKro013a7v9TFZ6KYiOmL6QWM7');                           //local
            Echeck::setEnviroment("SANDBOX");
            $this->echeck = new Echeck();
        }catch(Exception $e){
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode())->send();
        }
    }

    public function getBankAccounts()
    {
        $data = [] ;
        $accounts = $this->echeck->retrieveBankAccounts();
        foreach($accounts as $account)
        {
            if(!empty($account['id'])){
                $data[] = [
                    "id" => $account['id'] ,
                    "name" => $account['accountName']
                ];
            }
        }

        return $data ;
    }

    public function sendMail(array $data)
    {
        $send_data = [
            "PayeeName" => $data['payee_name'] ,
            "Amount"    => $data['amount'] ,
            "Memo"    => $data['memo'] ,
            "BankAccountId"    =>  $data['bankaccount'] ,
            "Address1"    => $data['address1'] ,
            "Address2"    => $data['address2'] ,
            "City"    => $data['city'] ,
            "State"    => $data['state'] ,
            "Zip"    => $data['zip'] ,
            "Country"   => $data['country'] ,
            "MailType" => $data['shipping'] ,
            "AttachmentUrl" => $data['attachment_url'] ?? ""
        ];

        try {
            $response =  $this->echeck->mailAcheck($send_data);
            CheckRecord::create([
                "type" => 1 ,
                "status" => "new" ,
                "data"   => json_encode($send_data) ,
                "check_id" => $response['CheckId']
            ]);
            return response()->json($response,200);
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }
    }

    public function sendEMail(array $data)
    {
        $send_data = [
            "PayeeName" => $data['payee_name'] ,
            "Amount"    => $data['amount'] ,
            "Memo"    => $data['memo'] ,
            "BankAccountId"    =>  $data['bankaccount'] ,
            "EmailAddress"     => $data['email'] ,
            "AttachmentUrl" => $data['attachment_url'] ?? ""
        ];

        try {
            $response =  $this->echeck->emailAcheck($send_data);
            CheckRecord::create([
                "type" => 2 ,
                "status" => "new" ,
                "data"   => json_encode($send_data) ,
                "check_id" => $response['CheckId']
            ]);
            return response()->json($response,200);
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }

    }

    public function getCheckList($search_params)
    {
        try {
            return $this->echeck->getCheckList($search_params);
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }
    }

    public function voidACheck($id)
    {
        try {
            return $this->echeck->voidCheck($id);
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }
    }

    public function viewACheck($id)
    {
        try {
            return $this->echeck->viewCheckStatement($id);
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }
    }

    public function printCheck($id)
    {
        try {
            return $this->echeck->viewCheckPdf($id);
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }
    }
}
