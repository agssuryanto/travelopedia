<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;
use App\Classes\PostsClasses;
use App\Classes\UploadClasses;
use App\Classes\LogClasses;
use App\Classes\ExpertClasses;

class ExpertController extends Controller
{

    public function home()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $expert = new ExpertClasses();
        $server_output = $expert->getUserPosts($dataRegister['token'], $data['profile']->user_id);
        $data['posts'] = json_decode($server_output);
        return view('expert.home', compact('data'));
    }

    public function detail($id)
    {
        $dataRegister['token'] = Session::get('token');
        $expert = new ExpertClasses();
        $server_output = $expert->trip_detail($dataRegister['token'], $id);
        $data['posts'] = json_decode($server_output);
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;
        return view('expert.detail', compact('data'));
    }

    public function profile()
    {
        $profile = Session::get('profile');
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
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $expert = new ExpertClasses();
        $server_output = $expert->getUserPosts($dataRegister['token'], $data['profile']->user_id);
        $data['posts'] = json_decode($server_output);
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
