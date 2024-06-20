@extends('layouts.app')
<style>
    .card-body {
        padding: 20px;
    }
    .card-img {
        padding: 10px;
        max-width: 100%;
        height: auto;
    }
    .card-flex {
        display: flex;
        flex-direction: row; /* Ensures the images are in a row */
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
    .card-flex > div {
        flex: 1 1 30%; /* Adjusts the width and allows wrapping */
        text-align: center;
    }
    @media (max-width: 767.98px) {
        .card-flex {
            flex-direction: row; /* Maintains row direction on smaller screens */
        }
        .card-flex > div {
            flex: 1 1 30%; /* Smaller size for images in row */
            margin-bottom: 10px; /* Space between items */
        }
        .card-body {
            text-align: center;
        }
        .card-img {
            width: 100%; /* Adjust image size */
            max-width: 100px; /* Set a maximum width */
            margin: 0 auto;
        }
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($candidates as $candidate)
                
            
            <div class="card mb-3">
                <div class="card-flex">
                    <div>
                        <img src="{{ $candidate->presidentCandidate->user->user_photo ? $candidate->presidentCandidate->user->user_photo : asset('assets/img/team-1.jpg') }}" class="card-img img-fluid" alt="President Photo">
                    </div>
                    <div>
                        <img src="{{ $candidate->vicePresidentCandidate->user->user_photo ? $candidate->vicePresidentCandidate->user->user_photo : asset('assets/img/team-2.jpg') }}"  class="card-img img-fluid" alt="Vice President Photo">
                    </div>
                    <div>
                        <div class="card-body">
                            <h5 class="card-title"> {{ $candidate->presidentCandidate->user->name }}</h5>
                            <h5 class="card-title">{{ $candidate->vicePresidentCandidate->user->name }}</h5>
                            <a href="{{ route('user.vote.view', ['id' => $candidate->id]) }}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            
            
        </div>
    </div>
</div>

@endsection
