<?php

namespace App\Http\Controllers;

use App\Classes\LocationClasses;

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
}
