<?php

namespace App\Classes;

use Illuminate\Http\Request;

class PersonalClasses
{

    public function getInfo($uid)
    {
        $url = config('app.api') . "/getprofiles/" . $uid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return  $server_output;
    }
}
