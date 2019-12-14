<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\Classes\RoleClasses;
use App\Classes\UserClasses;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRegister['token'] = Session::get('token');
        $user = new UserClasses();
        $server_output = $user->getUser($dataRegister['token']);
        $datax = json_decode($server_output);

        $data['profile'] = Session::get('profile');
        $data['users'] = $datax;
        return view('admin/user-management/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataRegister['token'] = Session::get('token');
        $role = new RoleClasses();
        $server_output = $role->getRole($dataRegister['token']);
        $datax = json_decode($server_output);
        $data['roles'] = $datax;
        return view('admin/user-management/adduser', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataRegister['avatar'] = "";
        $today = date("Y-m-d H:i:s");
        $dataRegister['request'] = $today;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('user_id');
        $dataRegister['name'] = $request->input('user_name');
        $dataRegister['email'] = $request->input('email_address');
        $dataRegister['password'] = $request->input('user_pass');
        $dataRegister['phone_no'] = $request->input('phone_no');
        $dataRegister['role'] = $request->input('role_id');
        $dataRegister['status'] = $request->input('status');
        $dataRegister['userbio'] = $request->input('user_bio');

        $url = config('app.api') . "/adduser";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataRegister);

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        $data2['server_output'] = $server_output;
        $dataxx = json_decode($server_output);

        $data2['status'] = $dataxx->status;
        $data2['message'] = $dataxx->message;
        return response()->json($data2);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = new RoleClasses();
        $user = new UserClasses();

        $dataRegister['token'] = Session::get('token');
        $dataRegister['id'] = $id;
        $server_output = $role->getRole($dataRegister['token']);
        $datax = json_decode($server_output);
        $data['roles'] = $datax;

        $server_output = $user->getUserbyId($dataRegister);
        $datax = json_decode($server_output);

        $data['profile'] = Session::get('profile');
        $data['users'] = $datax;
        return view('admin/user-management/delete', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataRegister['token'] = Session::get('token');
        $dataRegister['id'] = $id;
        $role = new RoleClasses();
        $server_output = $role->getRole($dataRegister['token']);
        $datax = json_decode($server_output);
        $data['roles'] = $datax;

        $user = new UserClasses();
        $server_output = $user->getUserbyId($dataRegister);
        $datax = json_decode($server_output);

        $data['profile'] = Session::get('profile');
        $data['users'] = $datax;
        return view('admin/user-management/edituser', compact('data'));
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
        $dataRegister['token'] = Session::get('token');
        $dataRegister['id'] = $id;
        $dataRegister['user_id'] = $request->input('user_id');
        $dataRegister['username'] = $request->input('user_name');
        $dataRegister['useremail'] = $request->input('email_address');
        $dataRegister['userphone'] = $request->input('phone_no');
        $dataRegister['status'] = $request->input('status');
        $dataRegister['userbio'] = $request->input('user_bio');

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
            $datas = $datax->data;
        }
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

        $url = config('app.api') . "/deleteuser";
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
