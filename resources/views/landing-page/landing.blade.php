@extends('landing-page.main')
@section('content')
  <!-- ======= Main Section ======= -->
  <main id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            {{-- @foreach ($candidates as $candidate) --}}
          <h1 data-aos="fade-up">PEMIRA</h1>
          {{-- @endforeach --}}
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

  @endsection
