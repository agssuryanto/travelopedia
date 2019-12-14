<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Classes\PostsClasses;

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
}
