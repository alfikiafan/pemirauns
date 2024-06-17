@extends('layouts.guest')

@section('title', 'Pengumuman - PEMIRA UNS')

@section('content')

<div class="page-title" style="padding-top: 50px">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Pengumuman</h1>
                    <p class="mb-0">Lihat semua pengumuman terbaru terkait PEMIRA UNS.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="current">Pengumuman</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->


<div class="container">
    <div class="row">

        <div class="col-lg-8">

            <!-- Information Posts Section -->
            <section id="blog-posts" class="blog-posts section">

                <div class="container">
                    <div class="row gy-4">

                        @foreach($informations as $information)
                        <div class="col-12">
                            <article>

                                <h2 class="title">
                                    <a href="{{ route('guest.info.show', $information->id) }}">{{ $information->title }}</a>
                                </h2>

                                <div class="meta-top">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('guest.info.show', $information->id) }}"><time datetime="{{ $information->publish_date->format('Y-m-d') }}">{{ $information->publish_date->format('d M Y') }}</time></a></li>
                                    </ul>
                                </div>

                                <div class="content">
                                    <p>
                                        {{ Str::limit($information->content, 200) }}
                                    </p>
                                    <div class="read-more">
                                        <a href="{{ route('guest.info.show', $information->id) }}">Baca Selengkapnya</a>
                                    </div>
                                </div>

                            </article>
                        </div><!-- End post list item -->
                        @endforeach

                    </div><!-- End information posts list -->
                </div>

            </section><!-- /Information Posts Section -->

            <!-- Information Pagination Section -->
            <section id="blog-pagination" class="blog-pagination section">
              <div class="d-flex flex-column align-items-center my-4">
                <div class="mb-2">
                    <p class="mb-0 text-sm">
                        Showing {{ $informations->firstItem() }} to {{ $informations->lastItem() }} of {{ $informations->total() }} results
                    </p>
                </div>
                <div>
                    <ul class="pagination pagination-info justify-content-center mb-0">

                        <!-- Previous Page Link -->
                        <li class="page-item{{ $informations->onFirstPage() ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $informations->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-chevron-left" aria-hidden="true"></i></span>
                            </a>
                        </li>

                        <!-- Pagination Elements -->
                        @for ($i = 1; $i <= $informations->lastPage(); $i++)
                            <li class="page-item{{ $informations->currentPage() == $i ? ' active' : '' }}">
                                <a class="page-link" href="{{ $informations->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Next Page Link -->
                        <li class="page-item{{ $informations->hasMorePages() ? '' : ' disabled' }}">
                            <a class="page-link" href="{{ $informations->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-chevron-right" aria-hidden="true"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
          </section>
        </div>

        <div class="col-lg-4 sidebar">

            <div class="widgets-container">

                <!-- Search Widget -->
                <div class="search-widget widget-item">
                    <h3 class="widget-title">Cari</h3>
                    <form action="{{ route('guest.info.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request()->query('search') }}">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div><!--/Search Widget -->

                <!-- Recent Posts Widget -->
                <div class="recent-posts-widget widget-item">
                    <h3 class="widget-title">Informasi Terbaru</h3>
                    @foreach($recent_informations as $recent)
                    <div class="post-item">
                        <div>
                            <h4><a href="{{ route('guest.info.show', $recent->id) }}">{{ $recent->title }}</a></h4>
                            <time datetime="{{ $recent->publish_date->format('Y-m-d') }}">{{ $recent->publish_date->format('d M Y') }}</time>
                        </div>
                    </div><!-- End recent post item-->
                    @endforeach
                </div><!--/Recent Posts Widget -->

            </div>

        </div>

    </div>
</div>

@endsection
