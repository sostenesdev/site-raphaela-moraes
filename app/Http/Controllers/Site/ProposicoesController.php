<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProposicoesController extends Controller
{
    //index
    public function index()
    {
        $categorias = \App\Models\CategoriaProposicao::all();
        return view('site_v2.categorias_proposicoes', compact('categorias'));
    }


    public function porCategoria($slug)
    {
        $proposicoes = \App\Models\Proposicao::where('categoria',$slug)->get();
        return view('site_v2.proposicoes', compact('proposicoes'));
    }
}
