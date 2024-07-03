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
                <h6 class="m-0">Voter Monitoring</h6>
                <p class="text-sm">See all voters in your unit</p>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-2 text-sm">Pilih Status Akun:</span>
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <div class="position-relative">
                        <select name="filter" class="form-control text-xs" onchange="this.form.submit();">
                            <option value="">All Users</option>
                            <option value="approved" {{ $filter == 'approved' ? 'selected' : '' }}>
                                Approved
                            <option value="not_approved" {{ $filter == 'not_approved' ? 'selected' : '' }}>
                                Not Approved
                            </option>
                        </select>
                        <span class="position-absolute top-50 end-5 translate-middle-y">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-secondary text-xxs font-weight-bolder pe-3">NIM</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Nama</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Fakultas</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Angkatan</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Status Pemilihan</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">User Photo</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Student Card</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Status Akun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $voter)
                    <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $voter->nim }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $voter->name }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $voter->faculty }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $voter->batch }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $voter->vote_status }}</p>
                        </td>
                        <td>
                            @if($voter->user_photo)
                            <a href="{{ asset($voter->user_photo) }}" download>
                                <img src="{{ asset($voter->user_photo)}}" alt="User Photo" style="width: 50px; height: 50px;">
                            </a>
                            @else
                            <p class="text-xs font-weight-bold mb-0">N/A</p>
                            @endif
                        </td>
                        <td>
                            @if($voter->student_card)
                            <a href="{{ asset($voter->student_card) }}" download>
                                <img src="{{ asset($voter->student_card)}}" alt="Student Card" style="width: 65px; height: 50px;">
                            </a>
                            @else
                            <p class="text-xs font-weight-bold mb-0">N/A</p>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.updateAccountStatus') }}" method="POST" id="status-form-{{ $voter->id }}" class="pe-3">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $voter->id }}">
                                <div class="position-relative">
                                    <select name="user_status" class="form-control text-xs" required onchange="document.getElementById('status-form-{{ $voter->id }}').submit();">
                                        <option value="">Select Status</option>
                                        <option value="approved" {{ $voter->user_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $voter->user_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <span class="position-absolute top-50 end-5 translate-middle-y">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </div>
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
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                </p>
            </div>
            <div>
                <ul class="pagination pagination-info justify-content-center mb-0">
                <li class="page-item{{ $users->onFirstPage() ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true"><i class="fas fa-chevron-left" aria-hidden="true"></i></span>
                    </a>
                </li>

                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item{{ $users->currentPage() == $i ? ' active' : '' }}">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item{{ $users->hasMorePages() ? '' : ' disabled' }}">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-chevron-right" aria-hidden="true"></i></span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
