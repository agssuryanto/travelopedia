<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;

class UserprofileController extends Controller
{

    public function index()
    {
        $dataRegister['token'] = Session::get('token');
        $data['profile'] = Session::get('profile');

        $province = new ProvinceClasses();
        $server_output = $province->getProvince($dataRegister['token']);
        $datax = json_decode($server_output);

        $personal = new PersonalClasses();
        $data['personal'] = json_decode($personal->getInfo($data['profile']->user_id));
        $data['provinces'] = $datax;

        // print $data['profile']->user_id;
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;

        return view('admin/user-profile/index', compact('data'));
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
        $today = date("Y-m-d H:i:s");
        $dataRegister['request'] = $today;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['id'] = $id;
        $dataRegister['username'] = $request->input('username');
        $dataRegister['useremail'] = $request->input('useremail');
        $dataRegister['userphone'] = $request->input('userphone');
        $dataRegister['status'] = $request->input('status');
        $dataRegister['userbio'] = $request->input('userbio');

        $url = config('app.api') . "/updateuser";
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
        if ($datax->status == true) {
            Session::forget('profile');
            Session::put('profile', $datax->data);
        }

        return response()->json($datax);
    }

    public function destroy($id)
    {
        //
    }

    public function update_profile(Request $request)
    {
        $today = date("Y-m-d H:i:s");
        $dataRegister['request'] = $today;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['id'] = $request->input('id');
        $dataRegister['username'] = $request->input('username');
        $dataRegister['id_card'] = $request->input('id_card');
        $dataRegister['place_of_birth'] = $request->input('place_of_birth');
        $dataRegister['year_birth'] = $request->input('year_birth');
        $dataRegister['month_birth'] = $request->input('month_birth');
        $dataRegister['day_birth'] = $request->input('day_birth');
        $dataRegister['address'] = $request->input('address');
        $dataRegister['province'] = $request->input('province');
        $dataRegister['city'] = $request->input('city');
        $dataRegister['district'] = $request->input('district');
        $dataRegister['subdistrict'] = $request->input('subdistrict');

        $url = config('app.api') . "/updatepersonal";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $data['server_output'] = $server_output;
        $datax = json_decode($server_output);

        $data['status'] = $datax->status;
        $data['message'] = $datax->message;
        return response()->json($data);
    }
}
