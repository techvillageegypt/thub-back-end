<?php

namespace App\Helpers;
// require_once __DIR__ . '/vendor/autoload.php';

use DateTime;
use App\Events\Chat as EventsChat;


trait SmsTrait
{

    public function sendSms($phone, $msg) {

        \SMSGlobal\Credentials::set(env('SMSGLOBAL_APP_KEY'), env('SMSGLOBAL_APP_SECRET'));
        $sms = new \SMSGlobal\Resource\Sms();
        try {
            $response = $sms->sendToOne($phone, $msg);
            $response['messages'][0]['status'] == "Failed" ? $response = response()->json(['msg' => 'Faild Message'],400) :  $response = response()->json(['msg' => 'A confirmation code has been sent, check your inbox']);

        } catch (\Exception $e) {
            $response = response()->json(['msg' => 'invalid Number'],400);
        }

        return $response;

    }

}
