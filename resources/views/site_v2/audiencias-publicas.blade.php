@extends('layouts.site_v2.master')
@section('title', 'Audiências Públicas')
@section('header_content')
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-8 offset-lg-2 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Audiências Públicas</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
@endsection
@section('content')

<div class="container-fluid pt-2 pb-5">
    <div class="row newsletter-area text-center pt-3 pb-3 text-center">
        @if($audiencias->count() == 0)
            <div class="col col-12 pb-5 mb-2">
                <p class="text-muted">Nenhuma audiência pública cadastrada.</p>
            </div>
        @endif
        @foreach($audiencias as $a)
            <div class="col col-12 pb-5 mb-2">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>{{$a->titulo}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{$a->descricao}}</p>
                        @if($a->documento_base64)
                        <hr/>
                        <div class="card-footer text-center">
                            <a href="{{route('site.audiencias-publicas.download', $a->id)}}" class="btn btn-primary">
                                <i class="lni lni-download"></i> Baixar Documento ({{$a->documento_extensao}})
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div><br/>
        @endforeach
    </div>
</div>
@endsection
