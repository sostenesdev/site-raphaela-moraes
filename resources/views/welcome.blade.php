@extends('layouts.site_v2.master')
@section('title', 'Início')


@section('header_content')
      <!-- Start Hero Area -->
    <section class="hero-area" style="padding-top: 160px;">
        <!-- Single Slider -->
      <div class="container">
        <div class="hero-inner">
 
                <div class="row">
                    <div class="col-lg-6 co-12">
                        <div class="home-slider">
                            <div class="hero-text">
                                <h1 class="wow fadeInUp" data-wow-delay=".3">{{$model->titulo}}</h1>
                                <div id="heroDescricao" class="hero-descricao hero-descricao--collapsed wow fadeInUp" data-wow-delay=".5s">
                                    <h4 class="hero-subtitulo">{!! $model->subtitulo !!}</h4>
                                    <div class="hero-sobre">{!! $model->sobre_previa !!}</div>
                                </div>
                                <div class="button wow fadeInUp" data-wow-delay=".7s">
                                    <a href="javascript:void(0);" class="btn" id="btnSaibaMais" onclick="toggleHeroTexto()">Saiba Mais</a>
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
                        {{-- <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p> --}}
                    </div>
                </div>
            </div>
            <div class="row">
              @foreach($latestPosts as $lp)
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single News -->
                    <div class="single-news wow fadeInUp" data-wow-delay=".2s">
                        <div class="image">
                            @if(isset($lp->image))
                                <img class="thumb" width="30%" src="{{$lp->getImage()}}" alt="{{$lp->title}}">
                                @else
                                <img class="thumb" width="30%" src="" alt="{{$lp->title}}">
                            @endif
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
                            {{-- <a href="{{ route("site.post", ['slug'=>$servico->slug]) }}" class="btn">Saiba mais</a> --}}
                            <a href="{{ $servico->content_preview }}" target="blank" class="btn">Saiba mais</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
      </div>
    </div>
@endsection

@section('javascript')
<style>
    .hero-descricao {
        display: block;
        overflow: hidden;
        transition: max-height 0.5s ease;
    }
    .hero-descricao--collapsed {
        max-height: 8em;
        overflow: hidden;
        position: relative;
    }
    .hero-descricao--collapsed::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2.5em;
        background: linear-gradient(transparent, #f6f9fc);
        pointer-events: none;
    }
    .hero-descricao--expanded {
        max-height: 2000px;
    }
    .hero-descricao--expanded::after {
        display: none;
    }
    .hero-subtitulo {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 12px;
        line-height: 1.5;
        border-left: 3px solid #fd5189;
        padding-left: 12px;
    }
    .hero-sobre {
        font-size: 15px;
        font-weight: 400;
        color: #555;
        line-height: 1.7;
        text-align: justify;
    }
    .hero-sobre p {
        margin-bottom: 10px;
    }
    .hero-area .hero-inner {
        height: auto !important;
        min-height: 700px;
        padding-bottom: 60px;
    }
</style>
<script>
    function toggleHeroTexto() {
        var descricao = document.getElementById('heroDescricao');
        var btn = document.getElementById('btnSaibaMais');

        if (descricao.classList.contains('hero-descricao--collapsed')) {
            descricao.classList.remove('hero-descricao--collapsed');
            descricao.classList.add('hero-descricao--expanded');
            btn.textContent = 'Ver Menos';
        } else {
            descricao.classList.remove('hero-descricao--expanded');
            descricao.classList.add('hero-descricao--collapsed');
            btn.textContent = 'Saiba Mais';
        }
    }
</script>
@endsection