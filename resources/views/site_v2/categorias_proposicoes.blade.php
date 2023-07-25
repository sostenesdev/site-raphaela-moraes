@extends('layouts.site_v2.master')
@section('title', 'Início')
@section('header_content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Projetos</h1>
                        {{-- <p>{{$model->content_preview}}</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection
@section('content')



<div class="container pt-2 pb-5">
    <div class="row newsletter-area text-center pt-3 pb-3 text-center">
        <div class="row">
          {{-- <h3 class="pb-3">Projetos</h3> --}}
            @foreach($categorias as $c)
                <div class="col-lg-3 col-12">
                    <div class="mini-call-action wow fadeInRight" data-wow-delay=".4s">
                        <h4>{{$c->nome}}</h4>
                        {{-- <p>{{$servico->subtitle}}</p> --}}
                        <div class="button">
                            {{-- <a href="{{ route("site.post", ['slug'=>$servico->slug]) }}" class="btn">Saiba mais</a> --}}
                            <a href="{{ route('site.proposicoes.por-categoria',['slug'=>$c->slug]) }}" class="btn">Ver Projetos</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
      </div>
    </div>
@endsection
