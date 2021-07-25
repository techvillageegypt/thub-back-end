<?php
namespace App\Helpers;

use DateTime;
use App\Events\Chat as EventsChat;


trait HelperFunctionTrait
{

    /**
     * Generate Random String
     *
     * @param integer $length
     * @return void
     */
    public function randomCode($length = 8)
    {
         // 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
    ////****************************************************////
}
