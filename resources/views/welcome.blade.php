@extends('layouts.site_v2.master')
@section('title', 'Início')


@section('header_content')
      <!-- Start Hero Area -->
    <section class="hero-area">
        <!-- Single Slider -->
      <div class="container">
        <div class="hero-inner">
 
                <div class="row ">
                    <div class="col-lg-6 co-12">
                        <div class="home-slider">
                            <div class="hero-text">
                                <h1 class="wow fadeInUp" data-wow-delay=".3">{{$model->titulo}}</h1>
                                <span class="wow fadeInUp" data-wow-delay=".5s">{!!$model->subtitulo.$model->sobre_previa!!}<br></span>
                                <div class="button wow fadeInUp" data-wow-delay=".7s">
                                    <a href="#" class="btn">Saiba Mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>
    <!--/ End Hero Area -->
@endsection

@section('content')
             <!-- Start Latest News Area -->
    <div class="latest-news-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <span class="wow fadeInDown" data-wow-delay=".2s">ùltimas notícias</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Últimas Notícias</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
              @foreach($latestPosts as $lp)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single News -->
                    <div class="single-news wow fadeInUp" data-wow-delay=".2s">
                        <div class="image">
                            <img class="thumb" width="30%" src="{{$lp->getImage()}}" alt="#">
                        </div>
                        <div class="content-body">
                            <h4 class="title"><a href="{{ route("site.post", ['slug'=>$lp->slug]) }}">{{$lp->title}}</a></h4>
                            <p>{{$lp->content_preview}}</p>
                        </div>
                    </div>
                    <!-- End Single News -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Latest News Area -->
          <div class="container pt-2 pb-5">
    <div class="row newsletter-area text-center pt-3 pb-3">
        <div class="row">
          <h3 class="pb-3">Serviços Online</h3>
            @foreach($servicos as $servico)
                <div class="col-lg-3 col-12">
                    <div class="mini-call-action wow fadeInRight" data-wow-delay=".4s">
                        <h4>{{$servico->title}}</h4>
                        <p>{{$servico->subtitle}}</p>
                        <div class="button">
                            <a href="{{ route("site.post", ['slug'=>$servico->slug]) }}" class="btn">Saiba mais</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
      </div>
    </div>
@endsection