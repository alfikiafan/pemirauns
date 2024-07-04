@extends('layouts.app')

@section('content')
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
        <h6 class="m-0">Tambah Pemira</h6>
        <p class="m-0">Tambah pemira baru</p>
    </div>
    <div class="card-body pt-0">
            <form action="{{ route('admin.election.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nama Pemira</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="faculty">Fakultas</label>
                    @php
                    $user = Auth::user();
                    $isAdminFakultas = $user && $user->hasRole('admin_fakultas');
                    $isAdminUniv = $user && $user->hasRole('admin_univ');
                    @endphp
                    @if ($isAdminFakultas)
                        <input type="text" name="faculty" class="form-control" value="{{ $user->faculty }}" required readonly>
                    @elseif ($isAdminUniv)
                        <input type="text" name="faculty" class="form-control" value="Universitas" required readonly>
                    @else
                        <div class="form-group mb-3">
                            <label for="faculty">Fakultas</label>
                            <input type="text" name="faculty" class="form-control" value="{{ $election->faculty }}" required>
                        </div>
                    @endif
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
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('admin.candidates.index') }}" class="btn bg-gradient-info">Batal</a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
@endsection
