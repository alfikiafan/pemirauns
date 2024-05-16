@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Kandidat</h1>

    <!-- Informasi Profil Kandidat -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Profil Dasar</h2>
        </div>
        <div class="card-body">
            @if ($profile)
                <div class="profile-item mb-3">
                    <h3>Nama: {{ Auth::user()->name }}</h3>
                    <p><strong>NIM:</strong> {{ Auth::user()->nim }}</p>
                    <p><strong>Fakultas:</strong> {{ Auth::user()->faculty }}</p>
                    <p><strong>Biografi:</strong> {{ $profile->biography }}</p>
                    <p><strong>Visi:</strong> {{ $profile->vision }}</p>
                    <p><strong>Misi:</strong> {{ $profile->mission }}</p>
                    <p><strong>Tahun:</strong> {{ $profile->year }}</p>
                </div>
            @else
                <p>Profil belum diisi. Silakan isi profil Anda.</p>
            @endif
        </div>
    </div>

    <!-- Informasi Pemira -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Informasi Pemira</h2>
        </div>
        <div class="card-body">
            @foreach ($pemiras as $pemira)
                <div class="pemira-item mb-3">
                    <h3>{{ $pemira->faculty }} - {{ $pemira->type == 'university' ? 'Universitas' : 'Fakultas' }}</h3>
                    <p>{{ $pemira->information }}</p>
                    <p><strong>Mulai:</strong> {{ $pemira->start_datetime }}</p>
                    <p><strong>Berakhir:</strong> {{ $pemira->end_datetime }}</p>
                    <hr>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Informasi Umum -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Informasi Umum</h2>
        </div>
        <div class="card-body">
            @foreach ($informations as $info)
                <div class="information-item mb-3">
                    <h3>{{ $info->title }}</h3>
                    <p>{{ $info->content }}</p>
                    <p><strong>Diterbitkan pada:</strong> {{ $info->publish_date }}</p>
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
