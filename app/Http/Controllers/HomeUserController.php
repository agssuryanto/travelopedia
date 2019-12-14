<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;
use App\Classes\PostsClasses;

class HomeUserController extends Controller
{
    public function home()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $post = new PostsClasses();
        $server_output = $post->getUserPosts($dataRegister['token'], $data['profile']->user_id);
        $data['posts'] = json_decode($server_output);
        return view('finder.home', compact('data'));
    }

    public function profile()
    {
        $profile = Session::get('profile');
        return view('finder.profile', compact('profile'));
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
        return view('finder.personal', compact('data'));
    }
}
