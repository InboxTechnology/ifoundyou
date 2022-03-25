<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_mail($to_email, $send_data, $subject) {
        $to      =  $to_email;
        $subject =  $subject;
        $message =  $send_data;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .=  'Content-type: text/html; charset=iso 8859-1'."\r\n";
        // $headers .= 'From: Ifoundu <ifoundyou.com>' . "\r\n";
        $headers .= 'From: noreply@ifoundyou.com';
        return $result= mail($to, $subject, $message, $headers);
   }
}
