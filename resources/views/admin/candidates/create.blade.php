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
        <h6 class="m-0">Tambah Kandidat</h6>
        <p class="m-0">Tambah kandidat baru</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('admin.candidates.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="president_candidate_id" class="form-label">President Candidate</label>
                <select id="president_candidate_id" name="president_candidate_id" class="form-select" required>
                    @foreach ($presidentCandidates as $presidentCandidate)
                    <option value="{{ $presidentCandidate->id }}">{{ $presidentCandidate->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="vice_president_candidate_id" class="form-label">Vice President Candidate</label>
                <select id="vice_president_candidate_id" name="vice_president_candidate_id" class="form-select" required>
                    @foreach ($vicePresidentCandidates as $vicePresidentCandidate)
                    <option value="{{ $vicePresidentCandidate->id }}">{{ $vicePresidentCandidate->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="election_id" class="form-label">Election</label>
                <select id="election_id" name="election_id" class="form-select" required>
                    @foreach ($elections as $election)
                    <option value="{{ $election->id }}">{{ $election->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="video" class="form-label">Video Link</label>
                <input type="text" id="video" name="video" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="vision" class="form-label">Vision</label>
                <input type="text" id="vision" name="vision" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="mission" class="form-label">Mission</label>
                <input type="text" id="mission" name="mission" class="form-control" required>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('admin.candidates.index') }}" class="btn bg-gradient-info">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
