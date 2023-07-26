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
    
        @foreach($proposicoes as $p)
        <div class="row mt-5 mb-5">
            <div class="col col-12 mb-5">
                <!-- bootstrap card -->
                <div class="card  mb-5">
                <div class="card-header">
                    <h5 class="card-title">{{$p->titulo}}</h5>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col col-2">
                    <strong>Protocolo:</strong>
                    </div>
                    <div class="col col-10 text-left">
                        {{$p->protocolo}}
                    </div>
                </div><hr/>
                <div class="row">
                    <div class="col col-2">
                    <strong>Processo:</strong>
                    </div>
                    <div class="col col-10 text-left">
                        {{$p->processo}}
                    </div>
                </div><hr/>
                <div class="row">
                    <div class="col col-2">
                    <strong>Data:</strong>
                    </div>
                    <div class="col col-10 text-left">
                        {{(new DateTime($p->data))->format('d/m/Y')}}
                    </div>
                </div><hr/>
                </div>
                <div class="row mb-5">
                    <div class="col col-12 text-center">
                        <a class="btn btn-primary" href="{{$p->descricao}}">Saiba Mais</a>
                    </div>
                </div>
                </div>
            </div>
        </div>    
    @endforeach
    
</div>

@endsection
