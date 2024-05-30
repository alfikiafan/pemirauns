@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Manage Pemilih</h3>

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
            <h5>Monitoring Pemilih</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Fakultas</th>
                            <th>Angkatan</th>
                            <th>Status Pemilihan</th>
                            <th>User Photo</th>
                            <th>Student Card</th>
                            <th>Status Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $voter)
                        <tr>
                            <td>{{ $voter->name }}</td>
                            <td>{{ $voter->nim }}</td>
                            <td>{{ $voter->faculty }}</td>
                            <td>{{ $voter->batch }}</td>
                            <td>{{ $voter->vote_status }}</td>
                            <td>
                                @if($voter->user_photo)
                                <a href="{{ asset($voter->user_photo) }}" download>
                                    <img src="{{ asset($voter->user_photo)}}" alt="User Photo"
                                        style="width: 50px; height: 50px;">
                                </a>
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                @if($voter->student_card)
                                <a href="{{ asset($voter->student_card) }}" download>
                                    <img src="{{ asset($voter->student_card)}}" alt="Student Card"
                                        style="width: 65px; height: 50px;">
                                </a>
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.updateAccountStatus') }}" method="POST"
                                    id="status-form-{{ $voter->id }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $voter->id }}">
                                    <select name="user_status" class="form-control" required
                                        onchange="document.getElementById('status-form-{{ $voter->id }}').submit();">
                                        <option value="">Select Status</option>
                                        <option value="approved"
                                            {{ $voter->user_status == 'approved' ? 'selected' : '' }}>
                                            Approved
                                        </option>
                                        <option value="rejected"
                                            {{ $voter->user_status == 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection