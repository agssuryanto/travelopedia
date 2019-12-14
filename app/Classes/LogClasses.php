<?php

namespace App\Classes;

use Illuminate\Http\Request;

class LogClasses
{

    public function user_activity($token)
    {
        $dataRegister['token'] = $token;
        $url = config('app.api') . "/user_activity";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function user_network_info($token)
    {
        $dataRegister['token'] = $token;
        $url = config('app.api') . "/user_network_info";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function user_log_detail($token, $log_id)
    {
        $dataRegister['token'] = $token;
        $dataRegister['log_id'] = $log_id;
        $url = config('app.api') . "/user_log_detail";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    public function createLog($dataRegister)
    {
        // $dataRegister['token'] = $token;
        // $dataRegister['user_id'] = $request->input('user_id');
        // $dataRegister['created_at'] = date("Y-m-d H:i:s");
        // $dataRegister['activity']   = $request->input('activity');
        // $dataRegister['ip_address'] = $request->input('ip_address');
        // $dataRegister['lat']        = $request->input('lat');
        // $dataRegister['long']       = $request->input('long');
        // $dataRegister['reff_id']    = $request->input('reff_id');

        //$dataRegister['log_id'] = $log_id;
        $url = config('app.api') . "/store_log";
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
