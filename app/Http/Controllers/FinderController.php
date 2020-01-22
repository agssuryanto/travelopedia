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


class FinderController extends Controller
{

    public function index()
    {
        $data['profile'] = Session::get('profile');
        $dataRegister['token'] = Session::get('token');
        $post = new PostsClasses();
        $server_output = $post->getUserPosts($dataRegister['token'], $data['profile']->user_id);
        $data['posts'] = json_decode($server_output);

        $narasi = new NaratorClasses();
        $dataRegister['user_id'] = $data['profile']->user_id;
        $server_output = $narasi->getposts($dataRegister);
        $data['narasi'] = json_decode($server_output);
        return view('finder.home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $file_name = $_FILES['picture_profile']['name'];
            $source = $_FILES['picture_profile']['tmp_name'];
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        print $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
