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
                        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengguna</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $totalUsers }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pemilihan</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $totalElections }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kandidat</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $totalCandidates }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
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
                                        @foreach ($elections as $election)
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
                                                        @foreach ($election->candidates as $candidate)
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
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pengguna Disetujui</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $approvedUsers }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pengguna Belum Disetujui</p>
                                                <h5 class="font-weight-bolder mb-0">
                                                    {{ $notApprovedUsers }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .candidate-names span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection