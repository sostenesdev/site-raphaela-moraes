<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaginaInicial;
use App\Models\TipoProposicao;
use App\Models\Cargo;
use App\Models\Post;

class PaginaInicialController extends Controller
{
    public function index()
    {
        $posts = Post::All();
        $cargos = Cargo::All();
        $tipoProposicaoList = (new TipoProposicao())->getAll();
        $paginaInicial = PaginaInicial::orderBy('id', 'desc')->first();
        $paginaInicial = $paginaInicial == null ? new PaginaInicial() : $paginaInicial;
        return view('welcome',[
            'model' => $paginaInicial,
            'tipoProposicaoList' => $tipoProposicaoList,
            'cargos' => $cargos,
            'posts' => $posts
        ]);
    }
}
