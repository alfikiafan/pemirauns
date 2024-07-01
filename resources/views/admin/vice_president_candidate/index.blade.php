@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
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
        <h6 class="m-0">Vice President Candidates Table</h6>
        <p class="text-sm">See all vice president candidates in your unit</p>
      </div>
      <div class="ml-auto p-0">
        <a href="{{ route('vice-president-candidate.create') }}" class="btn bg-gradient-primary">Add Vice President Candidate</a>
      </div>
    </div>
  </div>
  <div class="card-body ml-auto pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Vice President Candidate Name</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Biography</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($vicePresidentCandidates as $candidate)
          <tr>
            <td>
              <h6 class="mb-0 text-sm">{{ $candidate->user->name ?? 'N/A' }}</h6>
            </td>
            <td>
              <h6 class="mb-0 text-sm" style="white-space: pre-wrap; word-wrap: break-word;">{{ $candidate->biography ?? 'N/A' }}</h6>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <a href="{{ route('vice-president-candidate.edit', $candidate) }}" class="me-2 badge bg-warning">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <form action="{{ route('vice-president-candidate.destroy', $candidate) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this candidate data?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="badge btn-action mb-0 ms-1 bg-danger" title="Delete this candidate data" style="border: 0px">
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
            Showing {{ $vicePresidentCandidates->firstItem() }} to {{ $vicePresidentCandidates->lastItem() }} of {{ $vicePresidentCandidates->total() }} results
            </p>
        </div>
        <div>
            <ul class="pagination pagination-info justify-content-center mb-0">
            <li class="page-item{{ $vicePresidentCandidates->onFirstPage() ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $vicePresidentCandidates->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
                </a>
            </li>

            @for ($i = 1; $i <= $vicePresidentCandidates->lastPage(); $i++)
                <li class="page-item{{ $vicePresidentCandidates->currentPage() == $i ? ' active' : '' }}">
                <a class="page-link" href="{{ $vicePresidentCandidates->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            <li class="page-item{{ $vicePresidentCandidates->hasMorePages() ? '' : ' disabled' }}">
                <a class="page-link" href="{{ $vicePresidentCandidates->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                </a>
            </li>
            </ul>
        </div>
    </div>
  </div>
</div>
@endsection
