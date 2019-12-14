<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;

class SubdistrictController extends Controller
{
    public function index()
    {
        $dataRegister['token'] = Session::get('token');
        $province = new ProvinceClasses();
        $server_output = $province->getProvince($dataRegister['token']);
        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);
        $data['profile'] = Session::get('profile');
        $data['provinces'] = $datax;

        return view('admin/subdistrict/index', compact('data'));
    }

    public function newdata(Request $request)
    {
        $province = $request->input('pid');
        $city = $request->input('cid');
        $district = $request->input('did');
        return view('admin/subdistrict/add', compact('province', 'city', 'district'));
    }

    public function create()
    {
        return view('admin/subdistrict/add');
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
        $dataRegister['subdistrict_name'] = $request->input('subdistrict_name');
        $dataRegister['zipcode'] = $request->input('zipcode');
        $dataRegister['status'] = $request->input('status');
        $dataRegister['p_id'] = $request->input('p_id');
        $dataRegister['c_id'] = $request->input('c_id');
        $dataRegister['d_id'] = $request->input('d_id');

        $url = config('app.api') . "/store-subdistrict";
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

        $url = config('app.api') . "/edit-subdistrict";
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
        $data['subdistricts'] = $datax;
        return view('admin/subdistrict/del', compact('data'));
    }

    public function edit($id)
    {
        $dataRegister['id'] = $id;
        $dataRegister['token'] = Session::get('token');

        $url = config('app.api') . "/edit-subdistrict";
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
        $data['subdistricts'] = $datax;
        return view('admin/subdistrict/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $dataRegister['id'] = $id;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('user_id');
        $dataRegister['subdistrict_name'] = $request->input('subdistrict_name');
        $dataRegister['zipcode'] = $request->input('zipcode');
        $dataRegister['status'] = $request->input('status');

        $url = config('app.api') . "/update-subdistrict";
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

        $url = config('app.api') . "/delete-subdistrict";
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
