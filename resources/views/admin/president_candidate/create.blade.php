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
        <h6 class="m-0">Tambah Kandidat Presiden</h6>
        <p class="m-0">Tambah Kandidat Presiden</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('president-candidate.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="president_candidate_id" class="form-label">Nama</label>
                <select id="president_candidate_id" name="president_candidate_id" class="form-select" required>
                    @foreach ($presidentCandidates as $candidate)
                    <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="biography" class="form-label">Biography</label>
                <input type="text" id="biography" name="biography" class="form-control" required>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('president-candidate.index') }}" class="btn bg-gradient-info">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
