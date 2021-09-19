<?php

namespace App\Helpers;
// require_once __DIR__ . '/vendor/autoload.php';

use DateTime;
use App\Events\Chat as EventsChat;


trait SmsTrait
{

    public function sendSms($phone, $msg, $from) {
        // dd('send');
        // get your REST API keys from MXT https://mxt.smsglobal.com/integrations
        // \SMSGlobal\Credentials::set('YOUR_API_KEY', 'YOUR_SECRET_KEY');
        \SMSGlobal\Credentials::set(env('SMSGLOBAL_APP_KEY'), env('SMSGLOBAL_APP_SECRET'));
    
        $sms = new \SMSGlobal\Resource\Sms();
    
        try {
            $response = $sms->sendToOne($phone, $msg);
            print_r($response['messages'][0]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        // return $response;

    }



    public function sendOtp($phone, $msg, $from) {
           // get your REST API keys from MXT https://mxt.smsglobal.com/integrations
        \SMSGlobal\Credentials::set(env('SMSGLOBAL_APP_KEY'), env('SMSGLOBAL_APP_SECRET'));

        $otp = new \SMSGlobal\Resource\Otp();

        try {
            // $response = $otp->send('DESTINATION_NUMBER', '{*code*} is your SMSGlobal verification code.');
            $response = $otp->send($phone, $msg);
            print_r($response);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }


  
}
