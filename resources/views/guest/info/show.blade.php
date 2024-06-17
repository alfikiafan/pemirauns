@extends('layouts.guest')

@section('title', $information->title . ' - Pengumuman PEMIRA UNS')

@section('content')

  <!-- ======= Main Section ======= -->
  <main id="main" class="main">
    <section class="home-blog bg-sand">
      <div class="container">
        <!-- section title -->
        <div class="row justify-content-md-center">
          <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="section-title text-center title-ex1">
              <h2>{{ $information->title }}</h2>
              <p>{{ \Carbon\Carbon::parse($information->publish_date)->format('d M Y') }}</p>
            </div>
          </div>
        </div>
        <!-- section title ends -->

        <!-- Single Pengumuman -->
        <div class="row">
          <div class="col-md-12">
            <div class="media blog-media">
              <div class="circle">
                <h5 class="day">{{ \Carbon\Carbon::parse($information->publish_date)->format('d') }}</h5>
                <span class="month">{{ \Carbon\Carbon::parse($information->publish_date)->format('M') }}</span>
              </div>
              <div class="media-body">
                <h5 class="mt-0">{{ $information->title }}</h5>
                <p>{{ $information->content }}</p>
              </div>
            </div>
          </div>
        </div>
        <!-- End Single Pengumuman -->

      </div>
    </section>
  </main><!-- End Main -->

@endsection
