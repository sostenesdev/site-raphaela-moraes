@extends('layouts.site_v2.master')
@section('title', 'Início')
@section('header_content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Projetos</h1>
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
    <div class="col col-12">
        @foreach($proposicoes as $p)
        <!-- bootstrap card -->
        <div class="card  mb-5">
        <div class="card-header">
            <h5 class="card-title">{{$p->titulo}}</h5>
        </div>
         <div class="card-body">
         <div class="row">
            <table class="table">
                <tr>
                    <td><strong>Protocolo:</strong></td>
                    <td>{{$p->protocolo}}</td>
                </tr>
                <tr>
                    <td><strong>Processo:</strong></td>
                    <td>{{$p->processo}}</td>
                </tr>
                <tr>
                    <td><strong>Data:</strong></td>
                    <td>{{$p->data}}</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col col-12 text-center">
                <a class="btn btn-primary" href="{{$p->descricao}}">Saiba Mais</a>
            </div>
        </div>
        </div>

        @endforeach
    </div>
</div>
</div>
@endsection
