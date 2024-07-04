@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success" id="success-message">
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

<div class="card mx-3 mb-4">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="m-0">Current Admin University</h6>
                <p class="text-sm">List of Admin University</p>
            </div>
            <div class="ml-auto p-0">
                <a href="{{ route('admin.admin_univ.create') }}" class="btn bg-gradient-primary">Add Admin Univ</a>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-secondary text-xxs font-weight-bolder pe-3">NIM</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Name</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Email</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminUnivs as $adminUniv)
                    <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $adminUniv->nim }}</p>
                        </td>
                        <td>
                            <h6 class="mb-0 text-sm">{{ $adminUniv->name }}</h6>
                        </td>
                        <td>
                            <h6 class="mb-0 text-sm">{{ $adminUniv->email }}</h6>
                        </td>
                        <td>
                            <form action="{{ route('admin.admin_univ.remove', $adminUniv->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove this admin_univ?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-action mb-0 ms-1 px-3 btn-danger"
                                    title="Remove this admin univ">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                    Showing {{ $adminUnivs->firstItem() }} to {{ $adminUnivs->lastItem() }} of {{ $adminUnivs->total() }}
                    entries
                </p>
            </div>
            <div>
                <ul class="pagination pagination-info justify-content-center mb-0">
                    <li class="page-item{{ $adminUnivs->onFirstPage() ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $adminUnivs->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $adminUnivs->lastPage(); $i++)
                    <li class="page-item{{ $adminUnivs->currentPage() == $i ? ' active' : '' }}">
                        <a class="page-link" href="{{ $adminUnivs->url($i) }}">{{ $i }}</a>
                    </li>
                    @endfor
                    <li class="page-item{{ $adminUnivs->currentPage() == $adminUnivs->lastPage() ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $adminUnivs->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection