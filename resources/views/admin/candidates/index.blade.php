@extends('layouts.app')

@section('content')

<div class="card mx-3 mb-4">
  <div class="card-header pb-0">
    <div class="d-flex align-items-center justify-content-between">
      <div>
        <h6 class="m-0">Candidates Table</h6>
        <p class="text-sm">See all candidates in your unit</p>
      </div>
      <div class="ml-auto p-0">
        <a href="{{ route('admin.candidates.create') }}" class="btn bg-gradient-primary">Create Candidate</a>
      </div>
    </div>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-secondary text-xxs font-weight-bolder pe-3">ID</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">President Candidate</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Vice President Candidate</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Election</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($candidates as $candidate)
          <tr>
            <td>
              <p class="text-xs font-weight-bold mb-0 ps-3">{{ $candidate->id }}</p>
            </td>
            <td>
              <h6 class="mb-0 text-sm">{{ $candidate->presidentCandidate->name }}</h6>
            </td>
            <td>
              <h6 class="mb-0 text-sm">{{ $candidate->vicePresidentCandidate->name }}</h6>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $candidate->election->name }}</p>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <a href="{{ route('admin.candidates.edit', $candidate) }}" class="me-2">
                  <button type="button" class="btn btn-action btn-primary mb-0 me-1" title="Edit this candidate data">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                </a>
                <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this candidate data?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-action mb-0 ms-1 btn-danger" title="Delete this candidate data">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
