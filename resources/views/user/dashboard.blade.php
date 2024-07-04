@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-primary d-flex align-items-center">
                    <i class="fas fa-tachometer-alt me-2 text-white"></i>
                    <span class="text-lg fw-bold text-white">{{ __('Dashboard Pemilih') }}</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        <h5>Selamat datang di Pemira UNS</h5>
                        <p>Di sini Anda dapat memilih kandidat yang Anda dukung untuk setiap pemilihan yang tersedia.</p>
                    </div>

                    <div class="mt-4">
                        <h5>Hasil Pemilu Saat Ini</h5>
                        @foreach ($elections as $election)
                        <div class="card mb-3">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xxs font-weight-bolder pe-3">Pemira</th>
                                            <th class="text-secondary text-xxs font-weight-bolder px-2">Fakultas</th>
                                            <th class="text-secondary text-xxs font-weight-bolder px-2">Tahun</th>
                                            <th class="text-secondary text-xxs font-weight-bolder px-2">Kandidat</th>
                                            <th class="text-secondary text-xxs font-weight-bolder px-2">Perolehan</th>
                                            <th class="text-secondary text-xxs font-weight-bolder ps-3">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($election->candidates as $candidate)
                                        <tr>
                                            <td class="align-middle text-sm">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-xs font-weight-bold mb-0 ps-3">{{ $election->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-xs">{{ $election->faculty }}</td>
                                            <td class="align-middle text-xs">{{ \Carbon\Carbon::parse($election->end_date)->year }}</td>
                                            <td colspan="2">
                                                <table class="table mb-0">
                                                    <tr>
                                                        <td class="align-middle text-xs font-weight-bold mb-0 ps-0">
                                                            <div class="candidate-names">
                                                                <span>{{ $candidate->presidentCandidate->user->name }}</span><br>
                                                                <span>{{ $candidate->vicePresidentCandidate->user->name }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-xs font-weight-bold mb-0 ps-0" style="width: 15%;">
                                                            {{ $candidate->votes ? $candidate->votes->count() : 0 }}
                                                        </td>
                                                        <td class="align-middle text-xs font-weight-bold mb-0 ps-0" style="width: 35%;">
                                                            <div class="progress-wrapper w-100 mx-auto">
                                                                <div class="progress-info">
                                                                    <div class="progress-percentage">
                                                                        @if ($election->votes->count() > 0 && $candidate->votes)
                                                                            <span class="text-xs font-weight-bold">{{ number_format(($candidate->votes->count() / $election->votes->count()) * 100, 2) }}%</span>
                                                                        @else
                                                                            <span class="text-xs font-weight-bold">0%</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-gradient-info" role="progressbar" 
                                                                        style="width: {{ $election->votes->count() > 0 && $candidate->votes ? ($candidate->votes->count() / $election->votes->count()) * 100 : 0 }}%" 
                                                                        aria-valuenow="{{ $election->votes->count() > 0 && $candidate->votes ? ($candidate->votes->count() / $election->votes->count()) * 100 : 0 }}" 
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
