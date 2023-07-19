<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjetosController extends Controller
{
    //index
    public function index()
    {
        
        return view('site.projetos.index');
    }
}
