<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;
use App\Classes\NaratorClasses;
use App\Classes\PostsClasses;
use App\Classes\LogClasses;

class NarratorController extends Controller
{

    public function home()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $data['profile']->user_id;
        $post = new NaratorClasses();
        $server_output = $post->single_user_activity($dataRegister);
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

    public function detail($id)
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $dataRegister['id'] = $id;
        $post = new NaratorClasses();
        $server_output = $post->single_narasi($dataRegister);
        $data['posts'] = json_decode($server_output);
        return view('narator.detail', compact('data'));
    }

    public function store(Request $request)
    {
        $dataNarasi['token'] = Session::get('token');
        $dataNarasi['user_id'] = $request->input('user_id');
        $dataNarasi['narasi_id'] = $request->input('narasi_id');
        $dataNarasi['posts_id'] = $request->input('posts_id');
        $dataNarasi['tags'] = $request->input('tags');
        $dataNarasi['wysiwyg'] = $request->input('wysiwyg');
        $post = new NaratorClasses();
        $server_output = $post->post_narasi($dataNarasi);
        $data['posts'] = json_decode($server_output);
        return response()->json($data);
    }

    public function posts()
    {
        $dataRegister['token'] = Session::get('token');
        $post = new NaratorClasses();
        $server_output = $post->getposts($dataRegister);
        $data['posts'] = json_decode($server_output);
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;
        return view('narator.posts', compact('data'));
    }

    public function create($id)
    {
        $data['profile'] = Session::get('profile');
        $data['token'] = Session::get('token');
        $post = new PostsClasses();
        $server_output = $post->getSinglePost($id);
        $data['posts'] = json_decode($server_output);
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;
        return view('narator.create', compact('data'));
    }
}
