@extends('layouts.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mx-3 mb-4">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="m-0">President Candidates Table</h6>
                    <p class="text-sm">See all president candidates in your unit</p>
                </div>
                <div class="ml-auto p-0">
                    <a href="{{ route('president-candidate.create') }}" class="btn bg-gradient-primary">Add Experience</a>
                    <a href="{{ route('president-candidate.create') }}" class="btn bg-gradient-primary">Add Achievment</a>
                </div>
            </div>
        </div>
        <div class="card-body ml-auto pb-2">
            <div class="d-flex" style="flex-wrap: wrap;">
                <div class="me-3" style="max-width: 250px;">
                    <img style="max-width: 100%; height: auto;" src="{{ $candidate->user->user_photo }}" alt="">
                </div>
                <div style="flex: 1;">
                    <h3 class="mb-0 ">{{ $candidate->user->name ?? 'N/A' }}</h3>
                    <h3 class="mb-0 text-sm">Biografi</h3>
                    <p class="mb-0 text-sm" style="word-wrap: break-word;">{{ $candidate->biography ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
