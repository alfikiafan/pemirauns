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
        <p class="m-0">Edit kandidat yang sudah ada</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="president_candidate_id">President Candidate</label>
                <select id="president_candidate_id" name="president_candidate_id" class="form-control" required>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $candidate->president_candidate_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="vice_president_candidate_id">Vice President Candidate</label>
                <select id="vice_president_candidate_id" name="vice_president_candidate_id" class="form-control" required>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $candidate->vice_president_candidate_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="election_id">Election</label>
                <select id="election_id" name="election_id" class="form-control" required>
                    @foreach ($elections as $election)
                    <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected' : '' }}>{{ $election->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="video">Video Link</label>
                <input type="text" id="video" name="video" class="form-control" value="{{ $candidate->video }}" required>
            </div>
            <div class="form-group">
                <label for="vision">Vision</label>
                <input type="text" id="vision" name="vision" class="form-control" value="{{ $candidate->vision }}" required>
            </div>
            <div class="form-group">
                <label for="mission">Mission</label>
                <input type="text" id="mission" name="mission" class="form-control" value="{{ $candidate->mission }}" required>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-primary me-2">Update Data</button>
                    <a href="{{ route('admin.candidates.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
