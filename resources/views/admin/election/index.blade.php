@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4">Pemira Election Management</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
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

                                    <td class="d-block">
                                        {{-- edit --}}
                                        <a href="{{ route('admin.election.view', $election->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        {{-- delete --}}

                                        <form action="{{ route('admin.election.delete', $election->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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

       
    </div>
@endsection
