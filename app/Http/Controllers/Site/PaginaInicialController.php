<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaginaInicialController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
