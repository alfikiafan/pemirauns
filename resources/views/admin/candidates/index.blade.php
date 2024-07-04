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
@elseif (session('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>
@endif

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
              <th class="text-secondary text-xxs font-weight-bolder pe-3">President Candidate</th>
              <th class="text-secondary text-xxs font-weight-bolder px-2">Vice President Candidate</th>
              <th class="text-secondary text-xxs font-weight-bolder px-2">Pemira</th>
              <th class="text-secondary text-xxs font-weight-bolder px-2">Unit Pemira</th>
              <th class="text-secondary text-xxs font-weight-bolder ps-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($candidates as $candidate)
            <tr>
              <td>
                <p class="text-xs font-weight-bold mb-0 ps-3">{{ $candidate->presidentCandidate->user->name ?? 'N/A' }}</p>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ $candidate->vicePresidentCandidate->user->name ?? 'N/A' }}</p>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ $candidate->election->name }}</p>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{ $candidate->election->faculty ?? 'N/A' }}</p>
              </td>
              <td>
                <div class="d-flex align-items-center ps-3">
                  <a href="{{ route('admin.candidates.edit', $candidate) }}" class="me-2">
                    <button type="button" class="btn btn-sm btn-action btn-warning mb-0 me-1 px-3" title="Edit this candidate data">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                  </a>
                  <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this candidate data?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-action mb-0 ms-1 px-3 btn-danger" title="Delete this candidate data">
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
    <div class="d-flex flex-column align-items-center my-4">
      <div class="mb-2">
          <p class="mb-0 text-sm">
          Showing {{ $candidates->firstItem() }} to {{ $candidates->lastItem() }} of {{ $candidates->total() }} results
          </p>
      </div>
      <div>
          <ul class="pagination pagination-info justify-content-center mb-0">
          <li class="page-item{{ $candidates->onFirstPage() ? ' disabled' : '' }}">
              <a class="page-link" href="{{ $candidates->previousPageUrl() }}" aria-label="Previous">
              <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
              </a>
          </li>

          @for ($i = 1; $i <= $candidates->lastPage(); $i++)
              <li class="page-item{{ $candidates->currentPage() == $i ? ' active' : '' }}">
              <a class="page-link" href="{{ $candidates->url($i) }}">{{ $i }}</a>
              </li>
          @endfor

          <li class="page-item{{ $candidates->hasMorePages() ? '' : ' disabled' }}">
              <a class="page-link" href="{{ $candidates->nextPageUrl() }}" aria-label="Next">
              <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
              </a>
          </li>
          </ul>
      </div>
    </div>
  </div>
</div>
@endsection
