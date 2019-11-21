<?php 
namespace App;

class SendCode{

    public static function sendcode($phone){
        $code=rand(1111,9999);
        $nexmo= app('Nexmo\Client');
        $to ='0020'.(int)$phone;

        $nexmo->message()->send([
            'to'=>$to,
            'from'=>'1009739491',
            'text'=>'Verify Code'.$code,
            ]);

            return $code;
    }

}




