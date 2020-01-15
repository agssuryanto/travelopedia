<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;
use App\Classes\PostsClasses;
use App\Classes\UploadClasses;
use App\Classes\LogClasses;

class NarratorController extends Controller
{

    public function home()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $post = new PostsClasses();
        $server_output = $post->getUserPosts($dataRegister['token'], $data['profile']->user_id);
        $data['posts'] = json_decode($server_output);
        return view('narator.home', compact('data'));
    }

    public function logs()
    {
        $logs = new LogClasses();

        $data['profile'] = Session::get('profile');

        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $data['profile']->user_id;

        $server_output = $logs->single_user_activity($dataRegister);
        $data['log'] = json_decode($server_output);
        return view('narator.log', compact('data'));
    }

    public function profile()
    {
        $profile = Session::get('profile');
        return view('narator.profile', compact('profile'));
    }

    public function personalinfo()
    {

        $province = new ProvinceClasses();
        $personal = new PersonalClasses();

        $dataRegister['token'] = Session::get('token');
        $data['profile'] = Session::get('profile');

        $server_output = $province->getProvince($dataRegister['token']);
        $personal_info = $personal->getInfo($data['profile']->user_id);
        $datax = json_decode($server_output);
        $data['personal'] = json_decode($personal_info);
        $data['provinces'] = $datax;
        return view('narator.personal', compact('data'));
    }
}
