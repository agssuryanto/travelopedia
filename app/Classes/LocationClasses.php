<?php

namespace App\Classes;

use Illuminate\Http\Request;

class LocationClasses
{

    public function getLocation()
    {
        $url = config('app.api') . "/getlocation";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function getPopular()
    {
        $url = config('app.api') . "/getpopular";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }
}
