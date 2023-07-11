@extends('layouts.admin')

@section('title', 'Início')
@section('content')
  <div class="text-center">
        <h1>Olá, {{Auth::user()->name}}</h1>
        <p>Seja bem vindo ao painel de controle</p>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Empty card</h5>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection