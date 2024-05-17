@extends('landing-page.main')
@section('content')
    <!-- ======= Features Section ======= -->
    <section id="features" class="features">

        <div class="container" data-aos="fade-up">

            <header class="section-header mt-5">
                <h2>Paslon ID</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam, aspernatur.</p>
            </header>

            <!-- Feature Tabs -->
            <div class="row feture-tabs" data-aos="fade-up">
                <div class="col-lg-6">
                    <h3>{{ $selectedCandidate->name }}</h3>

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3">
                        <li>
                            <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Biografi</a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="pill" href="#tab2">Visi</a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="pill" href="#tab3">Misi</a>
                        </li>
                    </ul><!-- End Tabs -->

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab1">
                            <p>{{ $selectedCandidate->biography }}</p>
                        </div><!-- End Tab 1 Content -->

                        <div class="tab-pane fade show" id="tab2">
                            <p>{{ $selectedCandidate->vision }}</p>
                        </div><!-- End Tab 2 Content -->

                        <div class="tab-pane fade show" id="tab3">
                            <p>{{ $selectedCandidate->mission }}</p>
                        </div><!-- End Tab 3 Content -->

                    </div>

                </div>

                <div class="col-lg-6">
                    <img src="assets/img/features-2.png" class="img-fluid" alt="">
                </div>

            </div><!-- End Feature Tabs -->
        </div>

    </section><!-- End Features Section -->
@endsection
