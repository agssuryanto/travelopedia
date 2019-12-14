<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;

class FrontendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function home()
    {
        $profile = Session::get('profile');
        return view('user.index', compact('profile'));
    }

    public function profile()
    {
        $profile = Session::get('profile');
        $dataRegister['token'] = $profile->token;
        $province = new ProvinceClasses();
        $server_output = $province->getProvince($dataRegister['token']);
        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);
        $data['profile'] = $profile;
        $data['provinces'] = $datax;
        return view('user.profile', compact('profile', 'data'));
    }

    public function register()
    {
        return view('register');
    }

    public function doregister(Request $request)
    {
        $data['username'] = $request->input('username');
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        $data['user_type'] = $request->input('user_type');
        $data['phone_no'] = $request->input('phone_no');
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');
        $data['ip_address'] = $request->input('ip_address');
        $data['browsername'] = $request->input('browsername');
        $data['user_agent'] = $request->input('user_agent');
        $data['net_info'] = $request->input('net_info');

        Session::put('registerdata', $data);
        $url = config('app.api') . "/doRegister";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);
        return response()->json($datax);
    }
}
