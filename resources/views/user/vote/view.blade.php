@extends('layouts.app')

@section('content')
<style>
    .candidate-photo-container {
        width: 15rem;
        height: 15rem;
        overflow: hidden;
        margin-bottom: 1.25rem;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        border: 0.125rem solid #ddd;
    }

    .candidate-photo {
        width: 100%;
        height: auto;
    }

    .details-section {
        margin-top: 2rem;
    }

    .video-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        /* 16:9 aspect ratio (height / width) */
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    <div class="candidate-photo-container">
                        <img src="{{ $candidate->presidentCandidate->user->user_photo ? $candidate->presidentCandidate->user->user_photo : asset('assets/img/team-1.jpg') }}"
                            class="candidate-photo img-fluid" alt="President Photo">
                    </div>
                    <h5 class="mt-3">{{ $candidate->presidentCandidate->user->name }}</h5>
                </div>
                <div class="col-md-4 text-center">
                    <div class="candidate-photo-container">
                        <img src="{{ $candidate->vicePresidentCandidate->user->user_photo ? $candidate->vicePresidentCandidate->user->user_photo : asset('assets/img/team-2.jpg') }}"
                            class="candidate-photo img-fluid" alt="Vice President Photo">
                    </div>
                    <h5 class="mt-3">{{ $candidate->vicePresidentCandidate->user->name }}</h5>
                </div>
            </div>
            <div class="details-section mt-4">
                <h3 class="text-center">Candidate Details</h3>
                <hr>
                <h4>Video Presentation</h4>
                <div class="video-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/qgnMRNoT-PM?si=XOkxQJAEQaccEm9h"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <h4 class="mt-4">Vision</h4>
                <p>{{ $candidate->vision }}</p>
                <h4 class="mt-4">Mission</h4>
                <p>{{ $candidate->mission }}</p>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('user.vote.selfie', ['candidate_id' => $candidate->id]) }}" class="btn btn-primary btn-lg">Vote for {{ $candidate->presidentCandidate->user->name }}</a>
            </div>
        </div>
    </div>
</div>

@endsection
