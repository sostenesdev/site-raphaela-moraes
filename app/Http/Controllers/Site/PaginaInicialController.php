<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaginaInicial;

class PaginaInicialController extends Controller
{
    public function index()
    {
        $paginaInicial = PaginaInicial::orderBy('id', 'desc')->first();
        $paginaInicial = $paginaInicial == null ? new PaginaInicial() : $paginaInicial;
        return view('welcome',['model' => $paginaInicial]);
    }
}
