<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;


class EmendasController extends Controller
{
    //index
    public function index()
    {
        $emendas = \App\Models\Emenda::all();
        return view('site_v2.emendas', compact('emendas'));
    }
}
