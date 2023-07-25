<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProposicoesController extends Controller
{
    //index
    public function index()
    {
        $proposicoes = \App\Models\Proposicao::all();
        return view('site_v2.proposicoes', compact('proposicoes'));
    }
}
