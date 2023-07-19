@extends('layouts.site_v2.master')
@section('title', isset($title)? $title: "Ùltimos Posts")
@section('header_content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{isset($title)? $title: "Notícias"}}</h1>
                        {{-- <p>{{$model->content_preview}}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection
@section('content')
 <div class="latest-news-area section">
<div class="container mt-5">
    <div class="row mt-5">
    @foreach($model as $post)

        <div class="col-lg-4 col-md-6 col-12">
            <div class="single-news wow fadeInUp" data-wow-delay=".2s">
                <div class="image">
                    <img class="thumb" width="40%" src="{{$post->getImage()}}" alt="#">
                </div>
                <div class="content-body">
                    <h4 class="title"><a href="{{ route("site.post", ['slug'=>$post->slug]) }}">{{$post->title}}</a></h4>
                    <p>{{$post->content_preview}}</p>
                </div>
            </div>
            <!-- End Single News -->
        </div>
    @endforeach
    </div>
    </div>
    </div>

   <!-- pagination links -->
    <div class="row">
        <div class="col col-12">
            {!! $model->links('site.pagination') !!}
        </div>
    </div>
</div>
@endsection


{{-- @else
    <div class="row">
        <div class="col col-12">
            <h3 class="text-danger">Nenhum post encontrado</h3>
        </div>
    </div>
@endif 
@endsection--}}
