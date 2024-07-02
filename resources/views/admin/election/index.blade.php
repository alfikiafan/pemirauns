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
                <h6 class="m-0">Elections Table</h6>
                <p class="text-sm">See all Elections in your unit</p>
            </div>
            <div class="ml-auto p-0">
                <a href="{{ route('admin.election.create') }}" class="btn bg-gradient-primary">Create
                    Election</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-md-center">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Fakultas</th>
                        <th>Tanggal Dibuka</th>
                        <th>Tanggal Ditutup</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elections as $election)
                        <tr>
                            <td>{{ $election->name }}</td>
                            <td>{{ $election->faculty }}</td>
                            <td>{{ $election->start_date }}</td>
                            <td>{{ $election->end_date }}</td>
                            <td>
                                <div class="d-flex align-items-center ps-3">
                                    <a href="{{ route('admin.election.view', $election->id) }}" class="me-2">
                                    <button type="button" class="btn btn-sm btn-action btn-primary mb-0 me-1 px-3" title="Edit this candidate data">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    </a>
                                    <form action="{{ route('admin.election.delete', $election->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this election?');">
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
                    Showing {{ $elections->firstItem() }} to {{ $elections->lastItem() }} of
                    {{ $elections->total() }} results
                </p>
            </div>
            <div>
                <ul class="pagination pagination-info justify-content-center mb-0">
                    <li class="page-item{{ $elections->onFirstPage() ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $elections->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
                        </a>
                    </li>

                    @for ($i = 1; $i <= $elections->lastPage(); $i++)
                        <li class="page-item{{ $elections->currentPage() == $i ? ' active' : '' }}">
                            <a class="page-link" href="{{ $elections->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item{{ $elections->hasMorePages() ? '' : ' disabled' }}">
                        <a class="page-link" href="{{ $elections->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
