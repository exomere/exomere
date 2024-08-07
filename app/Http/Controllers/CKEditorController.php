<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CKEditorController extends Controller

{
 public function upload(Request $req)

    {
        if($req->hasFile('upload')):
            $image=$req->file('upload');
            $ext=$image->extension();
            $file=time().'.'.$ext;
            $image->move('uploads/',$file);
            $url = asset('uploads/'.$file);
            return response()->json(['fileName'=>$file,'uploaded'=>1,'url'=>$url]);
        endif;
    }


}
