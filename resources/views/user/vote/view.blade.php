@extends('layouts.app')
@section('content')
    <style>
        .candidate-photo-container {
            width: 15rem;
            /* Fixed width for the photo container */
            height: 15rem;
            /* Allow height to adjust based on image aspect ratio */
            overflow: hidden;
            /* Ensure photos don't overflow the container */

            margin-bottom: 1.25rem;
            /* Add space between photos */
            display: flex;
            /* Use flexbox for centering */
            justify-content: center;
            /* Center the image horizontally */
            align-items: center;
            /* Center the image vertically */
        }

        .candidate-photo {
            width: 100%;
            /* Ensure photo fills the container */
            height: auto;
            /* Allow the height to adjust based on image aspect ratio */
        }

        .photo-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            /* Prevent wrapping on smaller screens */
        }

        .details-section {
            margin-top: 1.25rem;
        }

        .vote-button {
            margin-top: 1.25rem;
            text-align: center;
        }

        .custom-container {
            padding: 1.25rem;
            border: 0.0625rem solid #ddd;
            /* Add border */
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            /* Add shadow */
            border-radius: 0.625rem;
            /* Optional: round the corners */
        }

        /* Media Query for Mobile Screens */
        @media (max-width: 768px) {
            .candidate-photo-container {
                width: 7.5rem;
                /* Set width to 7.5rem on mobile screens */
                height: 7.5rem;
                /* Set height to 7.5rem on mobile screens */
            }
        }
        .video-container {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio (height / width) */
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
    </style>
    <div class="container mt-5 custom-container">
        <!-- Photos Section -->
        <div class="row photo-section justify-content-between">
            <div class="col-5 text-center d-flex justify-content-end flex-column align-items-center">
                <div class="candidate-photo-container">
                    <img src="{{ $candidate->presidentCandidate->user->user_photo ? $candidate->presidentCandidate->user->user_photo : asset('assets/img/team-1.jpg') }}"
                        class="candidate-photo img-fluid" alt="President Photo">
                </div>
                <div class="mt-2 font-weight-bold">{{ $candidate->presidentCandidate->user->name }}</div>
            </div>
            <div class="col-5 text-center d-flex justify-content-start flex-column align-items-center">
                <div class="candidate-photo-container">
                    <img src="{{ $candidate->vicePresidentCandidate->user->user_photo ? $candidate->vicePresidentCandidate->user->user_photo : asset('assets/img/team-2.jpg') }}"
                        class="candidate-photo img-fluid" alt="Vice President Photo">
                </div>
                <div class="mt-2 font-weight-bold">{{ $candidate->vicePresidentCandidate->user->name }}</div>
            </div>
        </div>
        <!-- Details Section -->
        <div class="row details-section">
            <div class="col-md-12">
                <h3>Candidate Details</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo
                    mollis, auctor consequat urna.</p>
                <h4>Video</h4>
                <div class="video-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/qgnMRNoT-PM?si=XOkxQJAEQaccEm9h" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <h4>Vision</h4>
                <p>{{ $candidate->vision }}
                </p>
                <h4>Mission</h4>
                <p>{{ $candidate->mission }}
                </p>
            </div>
        </div>
        <!-- Vote Button Section -->
        <div class="row vote-button">
            <div class="col-md-12">
                <a href="{{ route('user.vote', ['id' => $candidate->id]) }}" class="btn btn-primary btn-lg">VOTE</a>
            </div>
        </div>
    </div>
@endsection
