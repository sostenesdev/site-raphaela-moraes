@extends('layouts.site_v2.master')
@section('title', 'Início')
@section('header_content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Organograma</h1>
                        {{-- <p>{{$model->content_preview}}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection
@section('content')

<div class="container">
<div class="row mt-5 mb-5">
    <div class="col col-12 col-lg-9 text-truncate">
        @foreach($cargos as $c)
        <!-- bootstrap card -->
        <div class="card  mb-5">
         <div class="card-body">
            <table class="table">
                <tr>
                    <td><strong>Nome:</strong></td>
                    <td>{{$c->pessoa_nome}}</td>
                </tr>
                <tr>
                    <td><strong>Cargo:</strong></td>
                    <td>{{$c->cargo}}</td>
                </tr>
                <tr>
                    <td><strong>Função:</strong></td>
                    <td>{{$c->funcao}}</td>
                </tr>
                <tr>
                    <td><strong>Regime de Trabalho:</strong></td>
                    <td>{{$c->regime_trabalho == 0? 'Interno': 'Externo'}}</td>
                </tr>
                @if(isset($c->descricao))
                <tr>
                    <td><strong>Descrição:</strong></td>
                    <td>{{$c->descricao}}</td>
                </tr>
                @endif
            </table>
        </div>
        </div>
        @endforeach



    </div>
</div>
</div>
@endsection
