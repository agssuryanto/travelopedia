<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\PostsClasses;
use App\Classes\UploadClasses;

class PostsController extends Controller
{

    public function index()
    {
        $profile = Session::get('profile');
        $posts = new PostsClasses();

        $id = $profile->user_id;
        $role = $profile->role;
        if ($role == "1") {
            $data['popular'] = json_decode($posts->getPopular());
        } else {
            $data['popular'] = json_decode($posts->getbyId($id));
        }
        return view('admin.posts.index', compact('data'));
    }

    public function edit($id)
    {
        $posts = new PostsClasses();
        $data['popular'] = json_decode($posts->getSinglePost($id));
        return view('admin.posts.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data['status'] = true;
        $data['message'] = 'Success';
        $data['post_id'] = $request->input('post_id');
        $data['caption'] = $request->input('caption_name');
        $data['text_currator'] = $request->input('text_currator');
        return $data;
    }

    public function store(Request $request)
    {
        $upload = new UploadClasses();
        $today = date("Y-m-d H:i:s");
        $filename = $_FILES['picture_profile']['name'];
        $dataRegister['request'] = $today;
        $dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('id');
        $dataRegister['caption'] = $request->input('caption');
        $dataRegister['text_currator'] = $request->input('text_currator');
        $dataRegister['filename'] = $filename;

        if ($_FILES['picture_profile']['name']) {
            // $file_name = $_FILES['picture_profile']['name'];
            // $source = $_FILES['picture_profile']['tmp_name'];
            $datax['string_img'] = base64_encode(file_get_contents($request->file('picture_profile')));
            $datax['ext'] = $request->file('picture_profile')->getClientOriginalExtension();
            $datax['user_id'] = $request->input('id');

            $server_output = $upload->uploadImage($datax);
            $datax = json_decode($server_output);

            $data['status'] = $datax->status;
            $data['message'] = $datax->message;
            if ($datax->status == true) {
                //
            }
        }
    }
}
