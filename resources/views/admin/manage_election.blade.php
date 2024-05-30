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
                <h5>Pemira Election</h5>
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
                                <th>Deskripsi</th>
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
                                        {{-- detail deskripsi --}}
                                        <button class="btn btn-primary">Detail</button>

                                    </td>
                                    <td class="d-block">
                                        <button class="btn btn-primary">Edit</button>
                                        <form action="{{ route('admin.manage_delete-election', $election->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td>Pemilihan BEM FATISDA 2070</td>
                                <td>Fatisda</td>
                                <td>11 - 09 - 2070</td>
                                <td>30 - 09 - 2070</td>
                                <td>
                                    <button class="btn btn-primary">Detail</button>
                                </td>
                                <td class="d-block">
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Pemilihan BEM FATISDA 2070</td>
                                <td>Fatisda</td>
                                <td>11 - 09 - 2070</td>
                                <td>30 - 09 - 2070</td>
                                <td>
                                    <button class="btn btn-primary">Detail</button>
                                </td>
                                <td class="d-block">
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr> --}}
                            
                            
                            {{-- @foreach ($users as $voter)
                        <tr>
                            <td>{{ $voter->name }}</td>
                            <td>{{ $voter->nim }}</td>
                            <td>{{ $voter->faculty }}</td>
                            <td>{{ $voter->batch }}</td>
                            <td>{{ $voter->vote_status }}</td>
                            <td>
                                @if ($voter->user_photo)
                                <a href="{{ asset($voter->user_photo) }}" download>
                                    <img src="{{ asset($voter->user_photo)}}" alt="User Photo"
                                        style="width: 50px; height: 50px;">
                                </a>
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                @if ($voter->student_card)
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
                        @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Add Election</h5>
            </div>
            <div class="card-body">
                {{-- <form action="{{ route('add.admin.fakultas') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="user_id">Select User:</label>
                        <select name="user_id" class="form-control" required>
                            @foreach ($usersWithoutRole as $user)
                            <option value="{{ $user->id }}">{{ $user->nim }} - {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="faculty">Select Faculty:</label>
                        <select name="faculty" class="form-control" required>
                            @foreach ($faculties as $faculty)
                            <option value="{{ $faculty }}">{{ $faculty }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Admin Fakultas</button>
                </form>
                  --}}

                <form action="{{ route('admin.manage_create-election') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nama Pemira</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="faculty">Fakultas</label>
                        <input type="text" name="faculty" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="start_date">Tanggal Dibuka</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="end_date">Tanggal Ditutup</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Election</button>

            </div>
        </div>
    </div>
@endsection
