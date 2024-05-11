<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PEMIRA UNS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/landing-page/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing-page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing-page/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing-page/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing-page/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/landing-page/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/landing-page/css/landing.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    {{-- ======== Logo Navbar ========--}}
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/landing-page/img/logo_uns.png')}}" class="img-fluid" alt="">
      </a>
    {{-- ======== Logo Navbar ========--}}

    {{-- Navbar Item --}}
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Pengumuman</a></li>
          <li class="dropdown"><a href="#"><span>Paslon</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="#"><span>Paslon 1</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Visi Misi</a></li>
                  <li><a href="#">Video Kampanye</a></li>
                  <li><a href="#">Riwayat Prestasi</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>Paslon 2</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Visi Misi</a></li>
                  <li><a href="#">Video Kampanye</a></li>
                  <li><a href="#">Riwayat Prestasi</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>Paslon 3</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Visi Misi</a></li>
                  <li><a href="#">Video Kampanye</a></li>
                  <li><a href="#">Riwayat Prestasi</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Help</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">QnA</a></li>
                <li><a href="#">Customer Service</a></li>
            </ul>
          <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    <!-- End navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Main Section ======= -->
  <main id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">PEMIRA</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Pemilihan Raya untuk Pemimpin yang Sejahtera. Your Voice, Your Vote!</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="{{ route('register') }}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Register Now</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img p-5" data-aos="zoom-out" data-aos-delay="200">
          <img src="{{ asset('assets/landing-page/img/img_landpage.png')}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </main><!-- End Main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/landing-page/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/landing-page/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/landing-page/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/landing-page/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/landing-page/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/landing-page/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/landing-page/js/main.js') }}"></script>

</body>

</html>
