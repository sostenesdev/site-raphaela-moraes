<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{env('SITE_NAME')}} - @yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/site_v2/images/favicon.png')}}" />
    <!-- Place favicon.ico in the root directory -->

    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{asset('assets/site_v2/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/site_v2/css/LineIcons.2.0.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/site_v2/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/site_v2/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/site_v2/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/site_v2/css/main.css')}}" />

</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand logo" href="index.html">
                                <img class="logo1" src="{{asset('assets/site_v2/images/logo/logo_rosa.png')}}" alt="Logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="active" href="{{route('home')}}">Início</a></li>
                                    <li class="nav-item">
                                        <a href="{{route('site.latest-posts')}}">Notícias</a>
                                    </li>
                                    <li class="nav-item"><a href="#">Projetos</a></li>
                                    {{-- <li class="nav-item"><a href="#">Agenda</a> </li>
                                    <li class="nav-item"><a href="#">Emendas</a></li>
                                    <li class="nav-item"><a href="#">Serviços</a></li>
                                    <li class="nav-item"><a href="#">Organograma</a></li> --}}
                                    @foreach ($paginas as $p)
                                        <li class="nav-item"><a href="{{route('site.pagina', ['slug' => $p->slug])}}">{{$p->menu_title}}</a></li>
                                        
                                    @endforeach
                                    <!--<li class="nav-item"><a href="#">Blog</a></li>
                                    <li class="nav-item"><a href="contact.html">Contato</a></li> -->
                                </ul>
                            </div>
                            <!-- navbar collapse -->
                            <div class="button">
                                <a href="contact.html" class="btn">Contato</a>
                            </div>
                        </nav>
                        <!-- navbar -->

                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- navbar area -->
    </header>
    <!-- End Header Area -->
    <main>
    @yield('header_content')
    @yield('content')
    </main>
    
    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Middle Top -->
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="f-about single-footer">
                            <div class="logo">
                                <a href="index.html"><img src="{{asset('assets/site_v2/images/logo/logo_branca.png')}}" alt="Logo"></a>
                            </div>
                            <p>{{isset($subtitulo)?$subtitulo: ""}}</p>
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#"><i class="lni lni-instagram"></i></a></li>
                                    <li><a href="#"><i class="lni lni-twitter"></i></a></li>
                                    <li><a href="#"><i class="lni lni-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-link">
                            <h3>Links</h3>
                            <ul>
                                <li><a href="{{route('home')}}">Início</a></li>
                                <li><a href="{{route('site.latest-posts')}}">Notícias</a></li>
                                <li><a href="#">Projetos</a></li>
                                <li><a href="#">Organograma</a></li>
                                {{-- <li><a href="#">Agenda</a></li> --}}
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                            <div class="single-footer f-link">
                            <h3>Páginas</h3>
                            <ul>
                                @foreach ($paginas as $p)
                                    <li><a href="{{route('site.pagina', ['slug' => $p->slug])}}">{{$p->menu_title}}</a></li>
                                @endforeach
                               
                            </ul>
                        </div>
                       
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                       <div class="single-footer f-link">
                            <h3>Serviços</h3>
                            <ul>
                                @foreach ($servicos as $s)
                                    <li><a href="{{$s->content_preview}}>{{$s->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Middle -->
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-12">
                            <div class="left">
                                <p>Desenvolvido por <a href="#" rel="nofollow"
                                        target="_blank">SDO Sistemas</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top btn-hover">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{asset('assets/site_v2/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/count-up.min.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/tiny-slider.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/imagesloaded.min.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/isotope.min.js')}}"></script>
    <script src="{{asset('assets/site_v2/js/main.js')}}"></script>
    <script type="text/javascript">
        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });
    </script>
</body>

</html>