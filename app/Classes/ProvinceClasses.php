<?php

namespace App\Classes;

use Illuminate\Http\Request;

class ProvinceClasses
{

    public function getProvince($token)
    {
        $dataRegister['token'] = $token;
        $url = config('app.api') . "/getprovince";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return  $server_output;
    }
}
