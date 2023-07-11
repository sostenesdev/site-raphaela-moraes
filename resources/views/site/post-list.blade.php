@extends('layouts.site.master')
@section('title', 'Início')

{{-- Início do conteúdo da página inicial --}}
@section('content')
<!-- ##### Blog Area Start ##### -->
@if($posts != null && count($posts) > 0)

    @php
        $delay = 0.1;
    @endphp
    @foreach($posts as $post)

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
                            href="{{ route("site.post", ['slug'=>$post->slug]) }}">
                            <img src="{{ route('admin.file.get_image',['name' => $post->thumbnail]) }}"
                                alt="Thumbnail do post {{ $post->title }}">
                        </a>
                        <div class="post-date">
                            <a
                                href="{{ route("site.post", ['slug'=>$post->slug]) }}">{{ $post->created_at->format('d') }}
                                <span>{{ $post->created_at->format('M') }}</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <!-- Blog Content -->
                    <div class="single-blog-content">
                        <div class="line"></div>
                        <a href="{{ route("site.category", ['slug'=>$post->category()->slug]) }}"
                            class="post-tag">{{ $post->category()->name }}</a>
                        <h4><a href="{{ route("site.post", ['slug'=>$post->slug]) }}"
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

    <!-- pagination links -->
    <div class="row">
        <div class="col col-12">
            {!! $posts->links('site.pagination') !!}
        </div>
    </div>
    <!-- Load More -->
    {{-- <div class="load-more-btn mt-100 wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1000ms">
    <a href="#" class="btn original-btn">Leia Mais</a>
</div> --}}
@else
    <div class="row">
        <div class="col col-12">
            <h3 class="text-danger">Nenhum post encontrado</h3>
        </div>
    </div>
@endif
@endsection
