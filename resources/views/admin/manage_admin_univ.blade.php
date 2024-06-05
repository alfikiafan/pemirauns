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
                <h6 class="m-0">Current Admin Universitas</h6>
                <p class="text-sm">List of Admin Universitas</p>
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
                            <form action="{{ route('remove.admin.univ', $adminUniv->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove this admin_univ?');">
                                @csrf
                                <button type="submit" class="btn btn-action btn-danger mb-0 ms-1"
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
    </div>
</div>


<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <p class="m-0">Add Admin Univ</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('add.admin.univ') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User:</label>
                <select id="user_id" name="user_id" class="form-select" required>
                    @foreach ($usersWithoutRole as $user)
                    <option value="{{ $user->id }}">{{ $user->nim }} - {{ $user->name }}</option>
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