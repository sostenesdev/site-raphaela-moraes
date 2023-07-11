<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FileService;

class ArquivoController extends Controller
{

    //get file by id using file service
    public function getById($id){
        $fileService = new FileService();
        $arquivo = $fileService->getById($id);
        return $arquivo;
    }
    //get file by name using file service
    public function getByName($name){
        $fileService = new FileService();
        $arquivo = $fileService->getByName($name);

        if($arquivo != null && $arquivo->base64 != null){
            // $raw = base64_decode($arquivo->base64);
            // file_put_contents($arquivo->nome, $raw);
            return view('site.arquivo',['arquivo' => $arquivo->base64]);
        }
       return view('site.arquivo',['arquivo' => $arquivo->base64]);
    }


}
