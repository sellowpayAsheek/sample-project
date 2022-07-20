<?php

namespace App\Http\Service;

use App\Models\CheckRecord;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\ProcessWebhookJob;

class WebhookClass extends ProcessWebhookJob
{
    public function handle()
    {
        $payload = $this->webhookCall->payload;
        $check_id = $payload['data']['check_id'] ?? "" ;
        $status = $payload['data']['status'] ?? "" ;

        $record = CheckRecord::where('check_id',$check_id)->first();
        $record->status = $status ;
        $record->save();
    }
}
