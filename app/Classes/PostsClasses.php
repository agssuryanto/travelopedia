<?php

namespace App\Classes;

use Illuminate\Http\Request;

class PostsClasses
{

    public function getUserPosts($token, $uid)
    {
        $dataRegister['user_id'] = $uid;
        $dataRegister['token'] = $token;
        $url = config('app.api') . "/getpostbyId";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return  $server_output;
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

    public function getbyId($id)
    {
        $url = config('app.api') . "/getpopularbyId/" . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function getSinglePost($id)
    {
        $url = config('app.api') . "/getsinglepost/" . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function store($datax)
    {
        $url = config('app.api') . "/create";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datax);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function get_accomodation($dataRegister)
    {
        $url = config('app.api') . "/getAccomodation";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }
}
