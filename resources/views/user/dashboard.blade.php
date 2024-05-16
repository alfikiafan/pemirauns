@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>

        <!-- Informasi Pemilihan (Pemira) -->
        <h2>Pemilihan BEM UNS</h2>
        @if ($pemiraInfo)
            <p>{{ $pemiraInfo->content }}</p>
            <p>Publish Date: {{ $pemiraInfo->publish_date }}</p>
        @else
            <p>No information available about the upcoming election.</p>
        @endif

        <!-- Menu Pilihan -->
        <div>
            <h3>Menu</h3>
            <ul>
                <li><a href="{{ route('vote') }}">Vote</a> - Choose your preferred candidate.</li>
                <li><a href="{{ route('candidates.index') }}">Candidates</a> - View profiles of candidates.</li>
                <li><a href="{{ route('reports.create') }}">Report</a> - Report incidents or issues.</li>
            </ul>
        </div>
    </div>
@endsection
