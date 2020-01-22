<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\ProvinceClasses;
use App\Classes\PersonalClasses;
use App\Classes\PostsClasses;
use App\Classes\UploadClasses;
use App\Classes\LogClasses;
use App\Classes\NaratorClasses;

class HomeUserController extends Controller
{
    public function home()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $data['profile']->user_id;

        $post = new PostsClasses();
        $server_output = $post->getUserPosts($dataRegister['token'], $dataRegister['user_id']);
        $data['posts'] = json_decode($server_output);

        $server_output = $post->no_accomodation($dataRegister);
        $data['no_accomodation'] = json_decode($server_output);

        $narasi = new NaratorClasses();
        $dataRegister['user_id'] = $data['profile']->user_id;
        $server_output = $narasi->getposts($dataRegister);
        $data['narasi'] = json_decode($server_output);
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;
        return view('finder.home', compact('data'));
    }

    public function logs()
    {
        $logs = new LogClasses();

        $data['profile'] = Session::get('profile');

        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $data['profile']->user_id;

        $server_output = $logs->single_user_activity($dataRegister);
        $data['log'] = json_decode($server_output);
        return view('finder.log', compact('data'));
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

    public function posts(Request $request)
    {
        $data['profile'] = Session::get('profile');
        return view('finder.posts', compact('data'));
    }

    public function store(Request $request)
    {
        $uploadImage = new UploadClasses();
        $posts = new PostsClasses();

        $data['token'] = Session::get('token');
        $data['caption'] = $request->input('caption');
        $data['text_currator'] = $request->input('text_currator');
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');
        $data['user_id'] = $request->input('id');

        if ($_FILES['picture_profile']['name']) {
            $filename = $_FILES['picture_profile']['name'];
            // $file_name = $_FILES['picture_profile']['name'];
            // $source = $_FILES['picture_profile']['tmp_name'];
            $datax['string_img'] = base64_encode(file_get_contents($request->file('picture_profile')));
            $datax['ext'] = $request->file('picture_profile')->getClientOriginalExtension();
            $data['filename'] = $filename;

            $server_output = $uploadImage->uploadImage($datax);
            $datax = json_decode($server_output);

            $data['status'] = $datax->status;
            $data['message'] = $datax->message;
            if ($datax->status == true) {
                $data['image'] = $datax->link;
                $post_data = $posts->store($data);
                $result = json_decode($post_data);
                if ($result->status == true) {
                    $log = new LogClasses();
                    $dataRegister['token'] = $data['token'];
                    $dataRegister['user_id'] = $request->input('id');
                    $dataRegister['activity']   = "Post";
                    $dataRegister['ip_address'] = $request->input('ip_address');
                    $dataRegister['lat']        = $request->input('latitude');
                    $dataRegister['long']       = $request->input('longitude');
                    $dataRegister['reff_id']    = $result->reff_id;
                    $log_output = $log->createLog($dataRegister);
                    $datax = json_decode($log_output);
                }
            }
        }
        return response()->json($data);
    }

    public function edit($id)
    {
        $post_id = $id;
        $post = new PostsClasses();
        $data['post'] = json_decode($post->getSinglePost($post_id));

        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        // die;

        $data['profile'] = Session::get('profile');
        return view('finder.editposts', compact('data'));
    }

    public function update(Request $request)
    {
        $uploadImage = new UploadClasses();
        $posts = new PostsClasses();

        $data['token'] = Session::get('token');
        $data['caption'] = $request->input('caption');
        $data['text_currator'] = $request->input('text_currator');
        $data['latitude'] = $request->input('latitude');
        $data['longitude'] = $request->input('longitude');
        $data['user_id'] = $request->input('id');
        $data['posts_id'] = $request->input('posts_id');

        if ($_FILES['picture_profile']['name']) {
            $filename = $_FILES['picture_profile']['name'];
            // $file_name = $_FILES['picture_profile']['name'];
            // $source = $_FILES['picture_profile']['tmp_name'];
            $datax['string_img'] = base64_encode(file_get_contents($request->file('picture_profile')));
            $datax['ext'] = $request->file('picture_profile')->getClientOriginalExtension();
            $data['filename'] = $filename;

            $server_output = $uploadImage->uploadImage($datax);
            $datax = json_decode($server_output);

            $data['status'] = $datax->status;
            $data['message'] = $datax->message;
            if ($datax->status == true) {
                $data['image'] = $datax->link;
                $post_data = $posts->update($data);
                $result = json_decode($post_data);
                if ($result->status == true) {
                    $log = new LogClasses();
                    $dataRegister['token'] = $data['token'];
                    $dataRegister['user_id'] = $request->input('id');
                    $dataRegister['activity']   = "Update Post";
                    $dataRegister['ip_address'] = $request->input('ip_address');
                    $dataRegister['lat']        = $request->input('latitude');
                    $dataRegister['long']       = $request->input('longitude');
                    $dataRegister['reff_id']    = $result->reff_id;
                    $log_output = $log->createLog($dataRegister);
                    $datax = json_decode($log_output);
                }
            }
        } else {
            $post_data = $posts->update($data);
            $result = json_decode($post_data);
            if ($result->status == true) {
                $log = new LogClasses();
                $dataRegister['token'] = $data['token'];
                $dataRegister['user_id'] = $request->input('id');
                $dataRegister['activity']   = "Update Post";
                $dataRegister['ip_address'] = $request->input('ip_address');
                $dataRegister['lat']        = $request->input('latitude');
                $dataRegister['long']       = $request->input('longitude');
                $dataRegister['reff_id']    = $result->reff_id;
                $log_output = $log->createLog($dataRegister);
                $datax = json_decode($log_output);
            }
        }
        return response()->json($data);
    }
}
