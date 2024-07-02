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

<div class="card mx-3 mb-4">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="m-0">Current Faculty Admin</h6>
                <p class="text-sm">See all admin in your unit</p>
            </div>
            <div class="ml-auto p-0">
                <a href="{{ route('admin.admin_faculty.create') }}" class="btn bg-gradient-primary">Add Faculty
                    Admin</a>
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
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Admin Faculty</th>
                        <th class="text-secondary text-xxs font-weight-bolder px-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminFakuls as $adminFakultas)
                    <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $adminFakultas->nim }}</p>
                        </td>
                        <td>
                            <h6 class="mb-0 text-sm">{{ $adminFakultas->name }}</h6>
                        </td>
                        <td>
                            <h6 class="mb-0 text-sm">{{ $adminFakultas->email }}</h6>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $adminFakultas->pivot->faculty ?? 'N/A' }}</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('admin.admin_faculty.remove', $adminFakultas->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this admin_fakultas?');">
                                    @csrf
                                    <button type="submit" class="btn btn-action btn-danger mb-0 ms-1"
                                        title="Remove this admin fakultas">
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
    </div>
</div>
@endsection