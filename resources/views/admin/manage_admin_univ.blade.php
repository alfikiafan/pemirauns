<!-- resources/views/admin/manage_admin_univ.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Manage Admin Univ</h3>

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
            <h5>Current Admin Universitas</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminUnivs as $adminUniv)
                    <tr>
                        <td>{{ $adminUniv->nim }}</td>
                        <td>{{ $adminUniv->name }}</td>
                        <td>{{ $adminUniv->email }}</td>
                        <td>
                            <form action="{{ route('remove.admin.univ', $adminUniv->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove this admin_univ?');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Add Admin Universitas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('add.admin.univ') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="user_id">Select User:</label>
                    <select name="user_id" class="form-control" required>
                        @foreach ($usersWithoutRole as $user)
                        <option value="{{ $user->id }}">{{ $user->nim }} - {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Admin Univ</button>
            </form>
        </div>
    </div>
</div>
@endsection