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
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Add Election</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.election.create') }}" method="POST">
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
