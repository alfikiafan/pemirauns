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
          <li><a class="nav-link scrollto {{ request()->is('/') ? 'active' : '' }}" href="{{ route('landing') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="#">Pengumuman</a></li>
          <li class="dropdown"><a href="#"><span>Paslon</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                @foreach ($candidates as $candidate)
                <li class="dropdown"><a href="#"><span>Paslon {{ $loop->iteration }}</span> <i class="bi bi-chevron-right"></i></a>
                  <ul>
                    <li><a href="{{ route('candidate', $candidate->id) }}">Biografi</a></li>
                    <li><a href="#">Video Kampanye</a></li>
                    <li><a href="#">Riwayat Prestasi</a></li>
                  </ul>
                </li>
                @endforeach
              {{-- <li class="dropdown"><a href="#"><span>Paslon 2</span> <i class="bi bi-chevron-right"></i></a>
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
              </li> --}}
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
