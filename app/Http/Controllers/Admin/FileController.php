<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Facades\Image as Image;
//file facade
use Illuminate\Support\Facades\File;
//response facade
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    //A method to save the file from request in a folder and return the path
    public function save(Request $request){
        $file = $request->file('file');
        $path = $file->store('public/files');
        return $path;
    }

    public function saveImage(Request $request){

        //instantiate $validator
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //test validation and return the error
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $file = $request->file('file');
        $path = $file->store('public/images');
        //return $path in json format
        // return response()->json(['path'=>$path], 200);

        //return a url to the image and the image name in json format
        // return response()->json(['location'=>Storage::url($path), 'name'=>$file->getClientOriginalName()], 200);
        return response()->json(['location'=>Storage::url($path)], 200);
    }

    //a method to generate a thumbnail from an image
    public function generateThumbnail(Request $request){
        $file = $request->file('file');
        $path = $file->store('public/images');
        $thumbnail = Image::make($file)->resize(100, 100)->save('public/images/thumbnail/'.$file->hashName());
        return $thumbnail;

        //composer install to Intervention Image
        //composer require intervention/image

    }

    //a method to convert a phrase to slug
    public function slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    //a method that converts a phrase to a slug
    public function slug($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }   
        return $text;
    } 

         
    //return image from storage by name
    public function getImage($name){
        $path = storage_path('app/public/'.$name);
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);
        return $response; 
    }




}
