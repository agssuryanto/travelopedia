<?php

namespace App\Classes;

use Illuminate\Http\Request;

class ExpertClasses
{

    public function getUserPosts($token, $uid)
    {
        $dataRegister['user_id'] = $uid;
        $dataRegister['token'] = $token;
        $url = config('app.api') . "/expert_work";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return  $server_output;
    }

    public function trip_detail($token, $trip_id)
    {
        $dataRegister['trip_id'] = $trip_id;
        $dataRegister['token'] = $token;
        $url = config('app.api') . "/trip_detail";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return  $server_output;
    }
}
