<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class LogInOutController extends Controller
{
    function Login(Request $request)
    {
        $url = config('app.api') . "/auth/login";
        $post = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'ip_address' => $request->input('ip_address'),
            'browsername' => $request->input('browsername'),
            'user_agent' => $request->input('user_agent'),
            'net_info' => $request->input('net_info')
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);

        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);

        $data['status'] = $datax->status;
        $data['message'] = $datax->message;
        $data['token']  = $datax->token;
        $data['profile'] = $datax->data;

        Session::put('token', $datax->token);
        Session::put('profile', $datax->data);
        return response()->json($data);
    }

    public function Logout()
    {
        return view('login');
    }
}
