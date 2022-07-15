<?php

namespace App\Http\Service ;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator ;
use Spatie\WebhookClient\WebhookConfig;

class WebhookSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request,WebhookConfig $config): bool
    {
        $header = $request->header() ;
        $time = $header['timestamp'] ?? [] ;
        $current_timestamp = $time[0] ?? 0 ;
        $signature = $header['signature'][0] ?? "" ;
        $payload = $request->getContent() ;
        $hash = hash_hmac('sha256',$payload.$current_timestamp,$config->signingSecret);

        if($signature == $hash){
            return true ;
        }
        return false ;

    }
}
