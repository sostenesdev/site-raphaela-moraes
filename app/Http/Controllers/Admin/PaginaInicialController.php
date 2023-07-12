<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaginaInicial;
use App\Services\FileService;

class PaginaInicialController extends Controller
{
    public function index()
    {
        $paginaInicial = PaginaInicial::orderBy('id', 'desc')->first();
        $paginaInicial = $paginaInicial == null ? new PaginaInicial() : $paginaInicial;
        return view('admin.pagina-inicial',['model' => $paginaInicial]);
    }

    //save pagina inicial
    public function save(Request $request)
    {
        // dd($request->all());
        // $paginaInicial = PaginaInicial::orderBy('id', 'desc')->first();
        if($request->id == null){  
            $paginaInicial = new PaginaInicial();
            $fileService = new FileService();
            $file = $request->file('file');
            if($file != null){
                $arquivo = $fileService->save($request, 'file');
                $paginaInicial->imagem_principal = $arquivo->nome;
            }
            $paginaInicial->create($request->all());
        }else{
            $paginaInicial = PaginaInicial::find($request->id);
            $fileService = new FileService();
            $file = $request->file('file');
            if($file != null){
                $arquivo = $fileService->save($request, 'file');
                $paginaInicial->imagem_principal = $arquivo->nome;
            }
            $paginaInicial->update($request->all());
        }

        
        $paginaInicial->save();
        return redirect()->route('admin.pagina_inicial');
    }

}