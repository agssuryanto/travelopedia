<?php

namespace App\Http\Controllers;

use Session;
use App\Classes\LocationClasses;
use App\Classes\NaratorClasses;

class FrontendController extends Controller
{

    public function index()
    {

        $location = new LocationClasses();
        $data['posts'] = json_decode($location->getLocation());
        $data['popular'] = json_decode($location->getPopular());
        if ($data['posts'] != '') {
            return view('welcome', compact('data'));
        } else {
            return view('error.404');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function getinfo($id)
    {
        $role = "0";
        $profile = Session::get('profile');
        if ($profile) {
            $role = $profile->role;
        }
        if ($role == "1") {
            $layouts = "layouts.admin";
        } elseif ($role == "2") {
            $layouts = "layouts.user";
        } else {
            $layouts = "layouts.welcome";
        }

        $info = new NaratorClasses();
        $dataRegister['id'] = $id;
        $data['posts'] = json_decode($info->getinfo($dataRegister));
        return view('postinfo', compact('data', 'layouts'));
    }
}
