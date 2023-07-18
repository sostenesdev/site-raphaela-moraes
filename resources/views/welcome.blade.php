@extends('layouts.site_novo.master')
@section('title', 'Início')
{{-- Destaque só vai existir na página inicial --}}
@section('destaque_content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">

@endsection
{{-- Fim do destaque --}}
@section('header')
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">{{$model->titulo}}</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Início</a></li>
          <li><a class="nav-link scrollto" href="#about">Sobre</a></li>
          <li><a class="nav-link scrollto" href="#services">Proposições</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Publicações</a></li>
          <li><a class="nav-link scrollto" href="#team">Organograma</a></li>
          {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
          <li><a class="nav-link scrollto selected" href="#contact">Contato</a></li>
          {{-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
@endsection
@section('hero')
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>{{$model->titulo}}</h1>
          <h2>{{$model->subtitulo}}</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
           <div class="social-links mt-3">
              <a href="{{$model->twitter}}" class="btn btn-info"><i class="bx bxl-twitter"></i></a>
              <a href="{{$model->facebook}}" class="btn btn-primary"><i class="bx bxl-facebook"></i></a>
              <a href="{{$model->instagram}}" class="btn btn-danger"><i class="bx bxl-instagram"></i></a>
              <a href="{{$model->instagram}}" class="btn btn-success"><i class="bx bxl-whatsapp"></i></a>
            </div>
            {{-- <a href="#about" class="btn-get-started scrollto">Get Started</a> --}}
            {{-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ isset($model->imagem_principal)? $model->getImage() : asset('assets/site_novo/img/hero-img.png')}}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

@endsection
{{-- Início do conteúdo da página inicial --}}
@section('content')

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Sobre</h2>
        </div>

        <div class="row content">
          <div class="col col-12">
            <p>
              {!! $model->sobre_previa!!}
            </p>
          </div>

        </div>
      </div>
    </section><!-- End About Us Section -->


       <!-- ======= Services Section ======= -->
    <section id="portfolio" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Projetos</h2>
          {!! $model->texto_projetos!!}
        </div>

        <div class="row">
          @foreach ($posts as $p)
          <div class="col-xl-3 col-md-6 d-flex pb-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><img src={{$p->getImage()}} width="45%"></div>
              <h4><a href="#" target="blank">{{$p->title}}</a></h4>
              <p>{{$p->content_preview}}</p>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Proposições</h2>
          {!! $model->texto_projetos!!}
        </div>

        <div class="row">
          @foreach ($tipoProposicaoList as $tipo)
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch pb-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="https://serra.camarasempapel.com.br//spl/consulta-producao.aspx?tipo={{$tipo->id_integracao}}&autor=1396" target="blank">{{$tipo->nome}}</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Organograma</h2>
          <p>{!!$model->texto_organograma!!}</p>
        </div>

        <div class="row">
          @foreach($cargos as $cargo)
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
              <div class="member d-flex align-items-start">
                <div class="pic"><img src="{{asset('assets/site_novo/img/team/team-0.png')}}" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4>{{$cargo->cargo}}</h4>
                  <span>{{$cargo->funcao}}</span>
                  <p><strong>Nome:</strong>&nbsp;{{$cargo->pessoa_nome}}</p>
                  <p><strong>Regime de trabalho:</strong>&nbsp;{{$cargo->regime_trabalho==0?"Interno":"Externo"}}</p>
                  <div class="social">
                    <a href=""><i class="ri-twitter-fill"></i></a>
                    <a href=""><i class="ri-facebook-fill"></i></a>
                    <a href=""><i class="ri-instagram-fill"></i></a>
                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contato</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Endereço:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telefone:</h4>
                <p>+55 27 55488 55s</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nome</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Assunto</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Mensagem</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Carregando...</div>
                <div class="error-message"></div>
                <div class="sent-message">Sua mensagem foi enviada com sucesso!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

@endsection
