<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PEMIRA UNS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/guest/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/guest/css/main.css') }}" rel="stylesheet">
</head>

<body>

     <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('guest.landing') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/guest/img/logo_uns.png') }}" alt="Logo UNS" class="img-fluid">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('guest.landing') }}" class="active">Home</a></li>
                <li><a href="{{ route('guest.info.index') }}">Pengumuman</a></li>
                <li class="dropdown">
                    <a href="#"><span>Paslon</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="#"><span>Paslon 1</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Visi Misi</a></li>
                                <li><a href="#">Video Kampanye</a></li>
                                <li><a href="#">Riwayat Prestasi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#"><span>Paslon 2</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Visi Misi</a></li>
                                <li><a href="#">Video Kampanye</a></li>
                                <li><a href="#">Riwayat Prestasi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#"><span>Paslon 3</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Visi Misi</a></li>
                                <li><a href="#">Video Kampanye</a></li>
                                <li><a href="#">Riwayat Prestasi</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span>Help</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">QnA</a></li>
                        <li><a href="#">Customer Service</a></li>
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">Login</a>
      </div>
  </header>

    <!-- ======= Main Section ======= -->
    <main id="hero" class="hero d-flex align-items-center">
        <!-- Added margin-top to ensure content is below the fixed navbar -->
        <div class="container">
            <div class="row">
                <div class="page-wrapper mt-5">
                    <div class="container-fluid">
                        <div class="content mt-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-6 hero-img p-5" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assets/guest/img/img_landpage.png')}}" class="img-fluid" alt="">
                </div> -->
            </div>
        </div>

    </main><!-- End Main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/guest/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/guest/js/main.js') }}"></script>

</body>

</html>