<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{env('SITE_NAME')}}{{isset($page_title)? "- ".$page_title: "" }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/site_novo/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/site_novo/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/site_novo/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/site_novo/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/site_novo/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/site_novo/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/site_novo/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/site_novo/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/site_novo/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/site_novo/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Jul 05 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @yield('header')

  <!-- ======= Hero Section ======= -->
  @yield('hero')
  <main id="main">
  @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            {{-- <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form> 
          </div>
        </div>
      </div>
    </div> --}}

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>{{$model->titulo}}</h3>
            <p>
              {{-- A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br> --}}
              <strong>Telefone:</strong> (27) 90000-0000<br>
              <strong>E=mail:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Menu</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i><a href="#hero">Início</a></li>
              <li><i class="bx bx-chevron-right"></i><a href="#about">Sobre</a></li>
              <li><i class="bx bx-chevron-right"></i><a href="#services">Proposições</a></li>
              <li><i class="bx bx-chevron-right"></i><a href="#portfolio">Publicações</a></li>
              <li><i class="bx bx-chevron-right"></i><a href="#team">Organograma</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Proposições</h4>
            <ul>
            @foreach($tipoProposicaoList as $proposicao)
              <li><i class="bx bx-chevron-right"></i> 
              <a href="https://serra.camarasempapel.com.br//spl/consulta-producao.aspx?tipo={{$tipo->id_integracao}}&autor=1396"
                target="blank">{{$proposicao->nome}}</a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Redes sociais</h4>
            <p>Entre em contato pelos seguintes canais:</p>
            <div class="social-links mt-3">
              <a href="{{$model->twitter}}" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="{{$model->facebook}}" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="{{$model->instagram}}" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
              {{-- <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>SDO Sistemas</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/site_novo/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/site_novo/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/site_novo/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/site_novo/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/site_novo/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/site_novo/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('assets/site_novo/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/site_novo/js/main.js')}}"></script>

</body>

</html>