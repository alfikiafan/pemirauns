@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($candidates as $candidate)
            <div class="card mb-4 shadow-sm">
                <div class="row no-gutters">
                    <div class="col-md-3 text-center my-auto">
                        <img src="{{ $candidate->presidentCandidate->user->user_photo ? $candidate->presidentCandidate->user->user_photo : asset('assets/img/team-1.jpg') }}"
                            class="card-img img-fluid rounded-circle" alt="President Photo" style="max-width: 150px;">
                    </div>
                    <div class="col-md-3 text-center my-auto">
                        <img src="{{ $candidate->vicePresidentCandidate->user->user_photo ? $candidate->vicePresidentCandidate->user->user_photo : asset('assets/img/team-2.jpg') }}"
                            class="card-img img-fluid rounded-circle" alt="Vice President Photo" style="max-width: 150px;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-user-tie me-2 mb-0"></i>
                                <span class="candidate-name mb-0">{{ $candidate->presidentCandidate->user->name }}</span>
                                <a href="{{ route('user.president_candidate.profile', $candidate->presidentCandidate->id) }}" class="btn btn-link btn-sm ms-auto mb-0 text-decoration-none">Profile</a>
                            </h5>
                            <h5 class="d-flex align-items-center">
                                    <i class="fas fa-user-tie me-2 mb-0"></i>
                                    <span class="candidate-name mb-0">{{ $candidate->vicePresidentCandidate->user->name }}</span>
                                    <a href="{{ route('user.vice_president_candidate.profile', $candidate->vicePresidentCandidate->id) }}" class="btn btn-link btn-sm ms-auto mb-0 text-decoration-none">Profile</a>
                            </h5>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('user.vote.view', ['id' => $candidate->id]) }}" class="btn btn-primary btn-sm">Details</a>
                                <a href="{{ route('user.vote.selfie', ['candidate_id' => $candidate->id]) }}" class="btn btn-success btn-sm">Vote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .rounded-circle {
        aspect-ratio: 1;
    }
</style>

@endsection
