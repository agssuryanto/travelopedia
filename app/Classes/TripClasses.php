<?php

namespace App\Classes;

use Illuminate\Http\Request;

class TripClasses
{

    public function trip_detail($dataRegister)
    {
        $url = config('app.api') . "/trip_expert";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return  $server_output;
    }
}
