<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\Pagina;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;


class PaginaController extends Controller
{
    private $tipo_pagina = 'pagina';
    private $titulo = 'Página';
    //returns a method that displays the view posts
    public function index()
    {
        return view('admin.paginas.index',[
            'tipo_pagina' => $this->tipo_pagina,
            'titulo' => $this->titulo
        ]);
    }
    public function new()
    {
        return view('admin.paginas.edit', [
            'post' => new Pagina(),
            'tipo_pagina' => $this->tipo_pagina,
        'titulo' => 'Nova '.$this->titulo]);
    }

    //method that save a post with many categories
    public function save(Request $request)
    {
        $request->merge(['slug' => $request->slug.time(), 'tipo_pagina' => $this->tipo_pagina]);
        //validate the request
        $validationResult = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts|max:255'
        ]);
        //add validation messages
        $validationResult['slug.required'] = 'O campo slug é obrigatório';
        $validationResult['title.unique'] = 'O campo título deve ser único';
        $validationResult['slug.unique'] = 'O campo slug deve ser único';

        //tests if the validation was successful
        if (!$validationResult) {
            return redirect()->route('admin.posts',)->withErrors($validationResult);
        }
        // dd(auth()->user()->id);
        // dd($request->all());
        $post = Pagina::create($request->all());
        // $post->user_id = auth()->user()->id;

        $fileService = new FileService();

        $file = $request->file('file');
        if($file != null){
            // $base64 = $fileService->requestFileToBase64($request, 'file');
            $arquivo = $fileService->save($request, 'file');
            $post->image = $arquivo->nome;
            $post->save();
        }
        return redirect()->route('admin.'.$this->tipo_pagina);
    }

    //method that edits a post with many categories
    public function edit($id)
    {
        $post = Pagina::find($id);
        $post->categories;
        return view('admin.paginas.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'titulo' => 'Editar '.$this->titulo,
            'tipo_pagina' => $this->tipo_pagina]);
    }

    //method that updates a post with many categories
    public function update(Request $request)
    {
        $id = $request->id;
        $post = Pagina::find($id);
        //delete the old image
        $oldImage = $post->image;
        $oldThumbnail = $post->thumbnail;
        $file = $request->file('file');
        if($file != null){
            // $base64 = $fileService->requestFileToBase64($request, 'file');
            if($post->image != null){
                $arquivo = (new FileService())->update($request, $post->image, $fileName='file');
            }else{
                $arquivo =(new FileService())->save($request, 'file');
            }
            $post->image = $arquivo->nome;
        }

        $post->update($request->all());
        $post->user_id = auth()->user()->id;
        $post->updated_at = now();
        return redirect()->route('admin.'.$this->tipo_pagina);
    }

    //method that deletes a post with many categories
    public function delete($id)
    {
        $post = Pagina::find($id);
        // $post->categories()->detach();
        $post->delete();
        return redirect()->route('admin.'.$this->tipo_pagina);
    }

    //datatable method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Pagina(),'title', $request);
        return response()->json($response, 200);
    }

    //get a file from request and returns a url to the file
    public function imageUpload(Request $request)
    {
        $file = $request->file('file');
        $originalFilename = $file->getClientOriginalName();
        $originalFilenameWithTime = time()."_".$originalFilename;
        $file->storeAs('public', $originalFilenameWithTime);

        //generate a thumbnail
        $img = Image::make($file);
        $img->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->crop(300, 300, 0,0);
        //get filename without extension
        $fileName = pathinfo($originalFilename, PATHINFO_FILENAME);
        //get file extension
        $extension = $file->getClientOriginalExtension();
        $thumbnailFilename = time()."_".$fileName."_thumbnail.".$extension;
        $storagePath =storage_path('app/public/');
        $img->save($storagePath . $thumbnailFilename);
        //get the url of the thumbnail
        $return = ['url' => $originalFilenameWithTime, 'thumbnail' => $thumbnailFilename];
        //convert $return to stdin object and return
        return (object) $return;


    }

    //remove file from storage by name
    public function removeFile($name)
    {
        Storage::delete("/".$name);
    }

}
