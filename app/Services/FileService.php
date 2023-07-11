<?php

namespace App\Services;
use App\Models\Arquivo;

class FileService{

    //get file from request and convert to base64 string
    public function requestFileToBase64($request, $fileName){
        $file = $request->file($fileName);
        //get extension of file
        $type = $file->getClientOriginalExtension();
        //get file name
        $name = $file->getClientOriginalName();
        //add timestamp string to file name
        $name = time() . '_' . $name;

        $file = file_get_contents($file);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($file);
        return (object)['name'=> $name, 'extension'=>$type, 'base64'=> $base64];
    }

    public function save($request, $fileName = 'file'){
        $fileObject = $this->requestFileToBase64($request, $fileName);
        $arquivo = new Arquivo();
        $arquivo->nome = $fileObject->name;
        $arquivo->descricao = $fileObject->name;
        $arquivo->extensao = $fileObject->extension;
        $arquivo->base64 = $fileObject->base64;
        $arquivo->save();
        return $arquivo;
    }

    //update a file
    public function update($request,$oldFilename, $fileName = 'file'){
        $fileObject = $this->requestFileToBase64($request, $fileName);
        $arquivo = $this->getByName($oldFilename);
        $arquivo->nome = $fileObject->name;
        $arquivo->descricao = $fileObject->name;
        $arquivo->extensao = $fileObject->extension;
        $arquivo->base64 = $fileObject->base64;
        $arquivo->update();
        return $arquivo;
    }

    public function delete($id){
        $arquivo = Arquivo::find($id);
        if($arquivo){
            $arquivo->delete();
        }
    }
    //get file by name
    public function getByName($name){
        $arquivo = Arquivo::where('nome', $name)->first();
        return $arquivo;
    }

    //get file by id
    public function getById($id){
        $arquivo = Arquivo::find($id);
        return $arquivo;
    }

}
