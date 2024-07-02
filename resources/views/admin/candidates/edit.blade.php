@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <h6 class="m-0">Edit Kandidat</h6>
        <p class="m-0">Edit kandidat yang ada</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="president_candidate_id" class="form-label">President Candidate</label>
                <select id="president_candidate_id" name="president_candidate_id" class="form-select" required>
                    @foreach ($presidentCandidates as $presidentCandidate)
                        <option value="{{ $presidentCandidate->id }}"
                            @if($presidentCandidate->id == $candidate->president_candidate_id) selected @endif>
                            {{ $presidentCandidate->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="vice_president_candidate_id" class="form-label">Vice President Candidate</label>
                <select id="vice_president_candidate_id" name="vice_president_candidate_id" class="form-select" required>
                    @foreach ($vicePresidentCandidates as $vicePresidentCandidate)
                        <option value="{{ $vicePresidentCandidate->id }}"
                            @if($vicePresidentCandidate->id == $candidate->vice_president_candidate_id) selected @endif>
                            {{ $vicePresidentCandidate->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="election_id" class="form-label">Election</label>
                <select id="election_id" name="election_id" class="form-select" required>
                    @foreach ($elections as $election)
                        <option value="{{ $election->id }}"
                            @if($election->id == $candidate->election_id) selected @endif>
                            {{ $election->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="video" class="form-label">Video Link</label>
                <input type="text" id="video" name="video" class="form-control" value="{{ $candidate->video }}" required>
            </div>

            <div class="mb-3">
                <label for="vision" class="form-label">Vision</label>
                <input type="text" id="vision" name="vision" class="form-control" value="{{ $candidate->vision }}" required>
            </div>

            <div class="mb-3">
                <label for="mission" class="form-label">Mission</label>
                <input type="text" id="mission" name="mission" class="form-control" value="{{ $candidate->mission }}" required>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.candidates.index') }}" class="btn bg-gradient-info">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
