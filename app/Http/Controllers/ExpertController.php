<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;
use App\Classes\PostsClasses;
use App\Classes\UploadClasses;
use App\Classes\LogClasses;

class ExpertController extends Controller
{

    public function home()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $post = new PostsClasses();
        $server_output = $post->getUserPosts($dataRegister['token'], $data['profile']->user_id);
        $data['posts'] = json_decode($server_output);
        return view('expert.home', compact('data'));
    }

    public function profile()
    {
        $profile = Session::get('profile');
        // print "<pre>";
        // print_r($profile);
        // print "</pre>";
        // die;
        return view('expert.profile', compact('profile'));
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
        return view('expert.personal', compact('data'));
    }

    public function trip()
    {
        $dataRegister['token'] = Session::get('token');
        $data['profile'] = Session::get('profile');
        return view('expert.trip', compact('data'));
    }

    public function create()
    {
        echo "Create Trip";
    }

    public function store(Request $request)
    {
        echo "Store";
    }
}
