@extends('layouts.app')

@section('content')

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

<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <p class="m-0">Add New Faculty Admin</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('admin.admin_faculty.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User:</label>
                <select id="user_id" name="user_id" class="form-select" required>
                    @foreach ($usersWithoutRole as $user)
                    <option value="{{ $user->id }}">{{ $user->nim }} - {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="faculty" class="form-label">Select Faculty:</label>
                <select id="faculty" name="faculty" class="form-select" required>
                    @foreach ($faculties as $faculty)
                    <option value="{{ $faculty }}">{{ $faculty }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection