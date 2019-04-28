<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Form\Field;
//use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function uploadImageContent()
    {
        $this->validate(request(), [
            'upload' => 'mimes:jpeg,jpg,gif,png'
        ]);

        $file = request()->file('upload');
        $filename = md5(uniqid()).'.'.$file->getClientOriginalExtension();


        $imagePath = "/upload/image/";



        $file->move(public_path() . $imagePath, $filename);

        $url = $imagePath . $filename;

//        return response()->json([
//            'uploaded' => 1,
//            'fileName' => $filename,
//            'url' => $url
//        ]);

//        echo "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";

        $funcNum = 1;
        $message = '';

//        $returnStr = '<script type="text/javascript">';
//        $returnStr .= 'window.parent.CKEDITOR.tools.callFunction(';
//        $returnStr .= $funcNum. ", '". $url. "', '". $message. "');</script>";
//        echo $returnStr;

        $ff = [
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => $url
        ];

        echo json_encode($ff);
    }


    public function attach()
    {
        $this->uploadImageContent(request()->all());
    }
}
