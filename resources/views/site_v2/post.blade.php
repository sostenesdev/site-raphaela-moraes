@extends('layouts.site_v2.master')
@section('title', 'Início')
@section('header_content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{$model->title}}</h1>
                        <p>{{$model->content_preview}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection
@section('content')

<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-12 col-lg-9 text-wrap">
            @if($model->image != null)
                <img src="{{ $model->getImage()}}"
                    alt="Thumbnail do post {{ $model->title }}">
            @endif
        </div>
    </div>
</div>
<div class="container">
<div class="row mt-5 mb-5">
    <div class="col col-12 col-lg-9 text-wrap">
        {!! $model->content !!}
    </div>
</div>
</div>
@endsection
