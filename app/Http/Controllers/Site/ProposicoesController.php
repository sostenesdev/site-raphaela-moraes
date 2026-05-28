<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProposicoesController extends Controller
{
    //index
    public function index()
    {
        $categorias = \App\Models\CategoriaProposicao::whereNotIn('slug', ['indicacao'])->get();
        return view('site_v2.categorias_proposicoes', compact('categorias'));
    }


    public function porCategoria($slug)
    {
        switch ($slug):
            case 'indicacao':
                $nomeCategoria = "Indicações";
                break;
            default:
                $nomeCategoria = "Projetos";
                break;
        endswitch;

        $proposicoes = \App\Models\Proposicao::where('categoria', $slug)->orderBy('id', 'desc')->get();
        return view('site_v2.proposicoes', compact('proposicoes', 'nomeCategoria'));
    }
}
