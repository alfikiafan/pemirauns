@extends('layouts.app')

@section('content')
<div class="card mx-3 mb-4">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h6 class="m-0">Vice President Candidate Detail</h6>
                <p class="text-sm">Detail informasi dari kandidat presiden</p>
            </div>
        </div>
    </div>
    <div class="card-body ml-auto pb-2">
        <div class="text-center mb-4">
            <img src="{{ $candidate->user->user_photo ?? 'https://th.bing.com/th/id/R.f9d1d02e235f4f92c92df15c2b9b6cd4?rik=6pXF9cllTGWm9w&riu=http%3a%2f%2fgetdrawings.com%2fimg%2fsilhouette-man-head-3.png&ehk=uEt0B0Ymfjd705T6e2A4cNl58g%2b23TWto8kV99nt5nU%3d&risl=&pid=ImgRaw&r=0' }}"
                alt="Profile Photo" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            <h3 class="mt-3 mb-0">{{ $candidate->user->name ?? 'N/A' }}</h3>
            <p class="text-muted mb-0">{{ $candidate->user->email ?? 'Email not available' }}</p>
        </div>
        <div>
            <h3 class="mb-3">Biografi</h3>
            <p class="text-sm" style="white-space: pre-line;">{{ $candidate->biography ?? '-' }}</p>
        </div>
        <hr>
        <div>
            <h3 class="mb-3">Pengalaman</h3>
            @if ($experience->isEmpty())
            <p class="text-sm text-muted">Belum ada pengalaman yang tersedia.</p>
            @else
            @foreach ($experience as $exp)
            <div class="mb-3">
                <h5 class="mb-1">{{ $exp->position }}</h5>
                <p class="text-sm mb-0">{{ $exp->range }}</p>
                <p class="text-sm">{{ $exp->description }}</p>
            </div>
            @endforeach
            @endif
        </div>
        <hr>
        <div>
            <h3 class="mb-3">Prestasi</h3>
            @if ($achievements->isEmpty())
            <p class="text-sm text-muted">Belum ada prestasi yang tersedia.</p>
            @else
            @foreach ($achievements as $ach)
            <div class="mb-3">
                <h5 class="mb-1">{{ $ach->name }}</h5>
                <p class="text-sm">{{ $ach->description }}</p>
            </div>
            @endforeach
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
            <a href="/user/candidates" class="btn bg-gradient-info">Kembali</a>
        </div>
    </div>
</div>
@endsection
