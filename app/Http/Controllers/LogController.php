<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\LogClasses;
use Session;

class LogController extends Controller
{

    public function user_activity()
    {
        $dataRegister['token'] = Session::get('token');
        $log = new LogClasses();
        $datax = $log->user_activity($dataRegister['token']);
        $data = json_decode($datax);
        return view('admin.log.activity', compact('data'));
    }

    public function user_network()
    {
        $dataRegister['token'] = Session::get('token');
        $log = new LogClasses();
        $datax = $log->user_network_info($dataRegister['token']);
        $data = json_decode($datax);
        return view('admin.log.network_info', compact('data'));
    }

    public function user_log_detail($id)
    {
        $log_id = $id;
        $dataRegister['token'] = Session::get('token');
        $log = new LogClasses();
        $datax = $log->user_log_detail($dataRegister['token'], $log_id);
        $data = json_decode($datax);
        return view('admin.log.user_log_detail', compact('data'));
    }
}
