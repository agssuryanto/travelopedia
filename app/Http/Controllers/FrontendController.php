<?php

namespace App\Http\Controllers;

use App\Classes\LocationClasses;
use App\Classes\NaratorClasses;

class FrontendController extends Controller
{

    public function index()
    {

        $location = new LocationClasses();
        $data['posts'] = json_decode($location->getLocation());
        $data['popular'] = json_decode($location->getPopular());
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;
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
        $info = new NaratorClasses();
        $dataRegister['id'] = $id;
        $data['posts'] = json_decode($info->getinfo($dataRegister));
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        return view('postinfo', compact('data'));
    }
}
