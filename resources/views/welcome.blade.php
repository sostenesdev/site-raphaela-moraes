@extends('layouts.site.master')
@section('title', 'Início')
{{-- Destaque só vai existir na página inicial --}}
@section('destaque_content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">

@endsection
{{-- Fim do destaque --}}

{{-- Início do conteúdo da página inicial --}}
@section('content')
<!-- ##### Blog Area Start ##### -->
@if($highlightedPosts != null && count($highlightedPosts) > 0)

    @php
        $delay = 0.1;
    @endphp
    @foreach($highlightedPosts as $post)

        @php
            $delay = $delay + 0.1;
        @endphp
        <!-- Single Blog Area  -->
        <div class="single-blog-area blog-style-2 mb-50 wow fadeInUp" data-wow-delay="{{ $delay }}"
            data-wow-duration="1000ms">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="single-blog-thumbnail">
                        <a
                            href="{{ route('site.post', ['slug'=>$post->slug]) }}">
                            <img src="{{ route('admin.file.get_image',['name' => $post->thumbnail]) }}"
                                alt="Thumbnail do post {{ $post->title }}">
                        </a>
                        <div class="post-date">
                            <a
                                href="{{ route('site.post', ['slug'=>$post->slug]) }}">{{ $post->created_at->format('d') }}
                                <span>{{ $post->created_at->format('M') }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                        <a href="#" class="post-tag">{{ $post->category()->name }}</a>
                        <h4><a href="{{ route('site.post', ['slug'=>$post->slug]) }}"
                                class="post-headline">{{ $post->title }}</a></h4>
                        <p>{{ $post->content_preview }}</p>
                        <div class="post-meta">
                            {{-- <p>By <a href="#">james smith</a></p>
                                        <p>3 comments</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Load More -->
    <div class="load-more-btn mt-100 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1000ms">
        <a href="#" class="btn original-btn">Leia Mais</a>
    </div>
@endif
@endsection
