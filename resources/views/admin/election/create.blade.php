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
    <div class="card">
        <div class="card-header">
            <h5>Add Election</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.election.store') }}" method="POST">
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
            </form>
            
        </div>
    </div>
@endsection
