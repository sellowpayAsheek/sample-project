<?php

namespace App\Http\Service;

use Echeck\Echeck;
use Exception;

class CommonService
{
    protected $echeck ;

    public function __construct()
    {
        try{
            Echeck::setToken("LmB7FXlU4KMCVle9IWccQmgsFUhaggEhQPUXK6sw5egQZlRUaGE2nK3EpLmq");
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
            "BankAccountId"    => $data['bankaccount'] ,
            "Address1"    => $data['address1'] ,
            "Address2"    => $data['address2'] ,
            "City"    => $data['city'] ,
            "State"    => $data['state'] ,
            "Zip"    => $data['zip'] ,
            "Country"   => $data['country'] ,
            "MailType" => $data['shipping']
        ];

        try {
            $response =  $this->echeck->mailAcheck($send_data);
            return response()->json($response,$e->getCode());
        } catch (Exception $e) {
            return response()->json(["success" => false , "error" => $e->getMessage()],$e->getCode());
        }
    }
}
