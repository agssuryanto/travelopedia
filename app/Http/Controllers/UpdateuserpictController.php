<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;
use App\Classes\UploadClasses;

class UpdateuserpictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $today = date("Y-m-d H:i:s");
        $filename = $_FILES['picture_profile']['name'];
		$dataRegister['request'] = $today;
		$dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('id');
        $dataRegister['filename'] = $filename;

		if ( $_FILES['picture_profile']['name'] )
		{
			$file_name = $_FILES['picture_profile']['name'];
			$source = $_FILES['picture_profile']['tmp_name'];
            $datax['string_img'] = base64_encode(file_get_contents($request->file('picture_profile')));
            $datax['ext'] = $request->file('picture_profile')->getClientOriginalExtension();
            $datax['user_id'] = $request->input('id');

            // $url = config('app.cdn')."/upload";
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $datax);

            // // Receive server response ...
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $server_output = curl_exec($ch);
            // curl_close ($ch);
            $server_output = $uploadImage->uploadImage($datax);
            $data['server_output'] = $server_output;
            $datax = json_decode($server_output);

            $data['status'] = $datax->status;
            $data['message'] = $datax->message;
            if ( $datax->status == true )
            {
                $avatar['link'] = $datax->link;
                $avatar['user_id'] = $request->input('id');
                $avatar['token'] = Session::get('token');

                $url = config('app.api')."/updateuser_picture";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $avatar);

                // Receive server response ...
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $update_output = curl_exec($ch);
                curl_close ($ch);

                $data['update_output'] = $update_output;
                $dataxx = json_decode($update_output);
                if ( $dataxx->status == true )
                {
                    $datas = $dataxx->data;
                    Session::forget('profile');
                    Session::put('profile', $datas);
                }
            }

        }

        $data['status'] = true;
        $data['message'] = "Update user picture successfully";

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
        //
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
        $today = date("Y-m-d H:i:s");
        $filename = $_FILES['picture_profile']['name'];
		$dataRegister['request'] = $today;
		$dataRegister['token'] = Session::get('token');
        $dataRegister['user_id'] = $request->input('id');
        $dataRegister['filename'] = $filename;

        $data['status'] = true;
        $data['message'] = "Update user picture successfully";
        return response()->json($data);
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
