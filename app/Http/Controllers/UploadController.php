<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;

class UploadController extends Controller
{

    function UploadHandling(Request $request)
    {
        
        $filename = $request->input('filename');
        $image = $request->input('image');
        $direktori = "C:/xampp/htdocs/application/travel_view/public/images/".$filename;
        file_put_contents($target_dir, base64_decode($image));

    }

}