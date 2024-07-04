@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-primary d-flex align-items-center">
                    <i class="fas fa-tachometer-alt me-2 text-white"></i>
                    <span class="text-lg fw-bold text-white">{{ __('Dashboard Admin') }}</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                                <div class="card bg-primary">
                                    <div class="card-header fw-bold">Total Pengguna</div>
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $totalUsers }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.election') }}" class="text-decoration-none">
                                <div class="card bg-primary">
                                    <div class="card-header fw-bold">Total Pemilihan</div>
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $totalElections }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('admin.candidates.index') }}" class="text-decoration-none">
                                <div class="card bg-primary">
                                    <div class="card-header fw-bold">Total Kandidat</div>
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $totalCandidates }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.users.index', ['filter' => 'approved']) }}" class="text-decoration-none">
                                <div class="card bg-primary">
                                    <div class="card-header fw-bold">Pengguna Disetujui</div>
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $approvedUsers }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.users.index', ['filter' => 'not_approved']) }}" class="text-decoration-none">
                                <div class="card bg-primary">
                                    <div class="card-header fw-bold">Pengguna Belum Disetujui</div>
                                    <div class="card-body">
                                        <h5 class="card-title text-white">{{ $notApprovedUsers }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
