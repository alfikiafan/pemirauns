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
        <h6 class="m-0">Information Table</h6>
        <p class="text-sm">See all information in your unit</p>
      </div>
      <div class="ml-auto p-0">
        <a href="{{ route('admin.information.create') }}" class="btn bg-gradient-primary">Create Information</a>
      </div>
    </div>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-secondary text-xxs font-weight-bolder pe-3">Title</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Publish Date</th>
            <th class="text-secondary text-xxs font-weight-bolder px-2">Author</th>
            <th class="text-secondary text-xxs font-weight-bolder ps-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($informations as $information)
          <tr>
            <td>
              <p class="text-xs font-weight-bold mb-0 ps-3">{{ $information->title }}</p>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $information->publish_date }}</p>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">{{ $information->user->name }}</p>
            </td>
            <td>
              <div class="d-flex align-items-center ps-2">
                <a href="{{ route('admin.information.show', $information->id) }}" class="me-2">
                    <button type="button" class="btn btn-sm btn-action btn-info mb-0 me-0 px-3" title="Show this information">
                        <i class="fas fa-eye"></i>
                    </button>
                </a>
                <a href="{{ route('admin.information.edit', $information->id) }}" class="me-2">
                  <button type="button" class="btn btn-sm btn-action btn-warning mb-0 me-0 px-3" title="Edit this information">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                </a>
                <form action="{{ route('admin.information.destroy', $information->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this information?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-action mb-0 ms-0 px-3 btn-danger" title="Delete this information">
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
            Showing {{ $informations->firstItem() }} to {{ $informations->lastItem() }} of {{ $informations->total() }} results
            </p>
        </div>
        <div>
            <ul class="pagination pagination-info justify-content-center mb-0">
            <li class="page-item{{ $informations->onFirstPage() ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $informations->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
                </a>
            </li>

            @for ($i = 1; $i <= $informations->lastPage(); $i++)
                <li class="page-item{{ $informations->currentPage() == $i ? ' active' : '' }}">
                <a class="page-link" href="{{ $informations->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            <li class="page-item{{ $informations->hasMorePages() ? '' : ' disabled' }}">
                <a class="page-link" href="{{ $informations->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                </a>
            </li>
            </ul>
        </div>
    </div>
  </div>
</div>
@endsection
