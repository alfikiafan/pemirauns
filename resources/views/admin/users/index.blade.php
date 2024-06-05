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
                <h6 class="m-0">Manage Pemilih</h6>
                <p class="text-sm">Monitoring Pemilih</p>
            </div>
            <div>
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <select name="filter" class="form-control text-xs" onchange="this.form.submit();">
                        <option value="">All Users</option>
                        <option value="not_approved" {{ $filter == 'not_approved' ? 'selected' : '' }}>
                            Not Approved
                        </option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Nama</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">NIM</th>
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
                            <p class="text-xs font-weight-bold mb-0">{{ $voter->name }}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $voter->nim }}</p>
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
                                <img src="{{ asset($voter->user_photo)}}" alt="User Photo"
                                    style="width: 50px; height: 50px;">
                            </a>
                            @else
                            <p class="text-xs font-weight-bold mb-0">N/A</p>
                            @endif
                        </td>
                        <td>
                            @if($voter->student_card)
                            <a href="{{ asset($voter->student_card) }}" download>
                                <img src="{{ asset($voter->student_card)}}" alt="Student Card"
                                    style="width: 65px; height: 50px;">
                            </a>
                            @else
                            <p class="text-xs font-weight-bold mb-0">N/A</p>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.updateAccountStatus') }}" method="POST"
                                id="status-form-{{ $voter->id }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $voter->id }}">
                                <select name="user_status" class="form-control text-xs" required
                                    onchange="document.getElementById('status-form-{{ $voter->id }}').submit();">
                                    <option value="">Select Status</option>
                                    <option value="approved" {{ $voter->user_status == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected" {{ $voter->user_status == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $users->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection