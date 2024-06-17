@extends('layouts.guest')

@section('title', $information->title . ' - Pengumuman PEMIRA UNS')

@section('content')

<div class="page-title" style="padding-top: 50px">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>{{ $information->title }}</h1>
                        <p class="mb-0">{{ $information->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('guest.landing') }}">Home</a></li>
                    <li class="current">{{ $information->title }}</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
              <div id="blog-details" class="blog-details section">
                <div class="container">

                  <article class="article">

                    <h2 class="title">{!! $information->title !!}</h2>

                    <div class="meta-top">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="{{ $information->created_at }}">{{ $information->created_at->format('M d, Y') }}</time></a></li>
                        </ul>
                    </div>

                    <div class="content">
                        {!! $information->content !!}
                    </div>
                  </article>
                </div>
            </div>
        </div>
        <div class="col-lg-4 sidebar">
          <div class="widgets-container">
            <div class="search-widget widget-item">
                <h3 class="widget-title">Cari</h3>
                <form action="{{ route('guest.info.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request()->query('search') }}">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="recent-posts-widget widget-item">
                <h3 class="widget-title">Informasi Terbaru</h3>
                @foreach($recent_informations as $recent)
                <div class="post-item">
                    <div>
                        <h4><a href="{{ route('guest.info.show', $recent->id) }}">{{ $recent->title }}</a></h4>
                        <time datetime="{{ $recent->publish_date->format('Y-m-d') }}">{{ $recent->publish_date->format('d M Y') }}</time>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
    </div>

@endsection
