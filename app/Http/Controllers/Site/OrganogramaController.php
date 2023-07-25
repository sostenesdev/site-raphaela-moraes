<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganogramaController extends Controller
{
    public function index()
    {
        $cargos = \App\Models\Cargo::all();
        return view('site_v2.organograma', compact('cargos'));
    }
}
