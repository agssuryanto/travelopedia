<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRegister['token'] = Session::get('token');
        $province = new ProvinceClasses();
        $server_output = $province->getProvince($dataRegister['token']);
        $datax = json_decode($server_output);

        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);
        $data['profile'] = Session::get('profile');
        $data['provinces'] = $datax;

        return view('admin/province/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/province/addprovince');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = date("Y-m-d H:i:s");
        $dataRegister['request'] = $today;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('user_id');
        $dataRegister['province_name'] = $request->input('province_name');
        $dataRegister['status'] = $request->input('status');
        $url = config('app.api') . "/store-province";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);

        $data['status'] = $datax->status;
        $data['message'] = $datax->message;
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataRegister['id'] = $id;
        $dataRegister['token'] = Session::get('token');

        $url = config('app.api') . "/edit-province";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $datax = json_decode($server_output);
        $data['provinces'] = $datax;
        return view('admin/province/delprovince', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataRegister['id'] = $id;
        $dataRegister['token'] = Session::get('token');

        $url = config('app.api') . "/edit-province";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        //$data['server_output'] = $server_output;
        $datax = json_decode($server_output);
        //$data['profile'] = Session::get('profile');
        $data['provinces'] = $datax;
        return view('admin/province/editprovince', compact('data'));
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
        $dataRegister['id'] = $id;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('user_id');
        $dataRegister['province_name'] = $request->input('province_name');
        $dataRegister['status'] = $request->input('status');

        $url = config('app.api') . "/update-province";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $datax = json_decode($server_output);

        $data['status'] = $datax->status;
        $data['message'] = $datax->message;
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Session::get('profile');
        $dataRegister['id'] = $id;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $profile->user_id;

        $url = config('app.api') . "/delete-province";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $datax = json_decode($server_output);

        $data['status'] = $datax->status;
        $data['message'] = $datax->message;
        return response()->json($data);
    }
}
