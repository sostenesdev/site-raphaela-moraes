<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\Post;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;


class ProjetoController extends Controller
{
    private $tipo_pagina = 'projeto';
    private $titulo = 'Projetos';
    //returns a method that displays the view posts
    public function index()
    {
        return view('admin.posts.index',[
            'tipo_pagina' => $this->tipo_pagina,
            'titulo' => $this->titulo
        ]);
    }
    public function new()
    {
        return view('admin.posts.edit', ['post' => new Post(), 'categories' => Category::all()]);
    }

    //method that save a post with many categories
    public function save(Request $request)
    {
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
        $post = Post::create($request->all());
        // $post->user_id = auth()->user()->id;

        $fileService = new FileService();

        $file = $request->file('file');
        if($file != null){
            // $base64 = $fileService->requestFileToBase64($request, 'file');
            $arquivo = $fileService->save($request, 'file');
            $post->image = $arquivo->nome;
            $post->thumbnail = $arquivo->nome;
            $post->tipo_pagina = $this->tipo_pagina;
            $post->save();
        }
        // if($file != null){
        //     $imgUrls = $this->imageUpload($request);
        //     $post->image = $imgUrls->url;
        //     $post->thumbnail = $imgUrls->thumbnail;
        //     $post->save();
        // }
        $post->categories()->attach($request->categories);
        return redirect()->route('admin.'.$this->tipo_pagina);
    }

    //method that edits a post with many categories
    public function edit($id)
    {
        $post = Post::find($id);
        $post->categories;
        return view('admin.posts.edit', ['post' => $post,'categories' => Category::all()]);
    }

    //method that updates a post with many categories
    public function update(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);
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
            $post->thumbnail = $arquivo->nome;
        }
        // if ($file!=null) {
        //     if ($oldImage) {
        //         $this->removeFile($oldImage);
        //         $this->removeFile($oldThumbnail);
        //     }
        //         $imgUrls = $this->imageUpload($request);
        //         $post->image = $imgUrls->url;
        //         $post->thumbnail = $imgUrls->thumbnail;
        // }
        $post->update($request->all());
        $post->user_id = auth()->user()->id;
        $post->updated_at = now();
        $post->tipo_pagina = $this->tipo_pagina;
        $post->categories()->sync($request->categories);
        return redirect()->route('admin.posts');
    }

    //method that deletes a post with many categories
    public function delete($id)
    {
        $post = Post::find($id);
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('admin.'.$this->tipo_pagina);
    }

    //datatable method
    public function data_table(Request $request)
    {
        $response = DatatableService::getDataWithBoolFilter(new Post(),'tipo_pagina', $this->tipo_pagina, 'title', $request);
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
