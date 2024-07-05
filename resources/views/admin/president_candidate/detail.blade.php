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
                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin_univ') || Auth::user()->hasRole('admin_fakultas'))
                    <a href="{{ route('experience.create', $candidate->user_id) }}" class="btn bg-gradient-primary">Add Experience</a>
                    <a href="{{ route('achievement.create', $candidate->user_id) }}" class="btn bg-gradient-primary">Add Achievement</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body ml-auto pb-2">
            <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                <img src="{{ $candidate->user->user_photo ?? 'https://th.bing.com/th/id/R.f9d1d02e235f4f92c92df15c2b9b6cd4?rik=6pXF9cllTGWm9w&riu=http%3a%2f%2fgetdrawings.com%2fimg%2fsilhouette-man-head-3.png&ehk=uEt0B0Ymfjd705T6e2A4cNl58g%2b23TWto8kV99nt5nU%3d&risl=&pid=ImgRaw&r=0' }}" alt="" style="max-width: 100px; max-height: 100px; margin-bottom: 20px;">
                <h3 class="mb-0 ">{{ $candidate->user->name ?? 'N/A' }}</h3>
            </div>
            <div>
                <h3 class="mb-2">Biografi</h3>
                <p class="mb-0 text-sm" style="word-wrap: break-word;">{{ $candidate->biography ?? '-' }}</p>
                <hr>
            </div>
                <div>
                    <h3 class="mb-2">Experience</h3>
                    @foreach ($experience as $exp)
                        <h4 class="mb-0 text-sm">Position</h4>
                        <p class="mb-0 text-sm">{{ $exp->position }}</p>
                        <h5 class="mb-0 text-sm">Tahun</h5>
                        <p class="mb-0 text-sm">{{ $exp->range }}</p>
                        <h5 class="mb-0 text-sm">Description</h5>
                        <p class="mb-2 text-sm">{{ $exp->description }}</p>
                        @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin_univ') || Auth::user()->hasRole('admin_fakultas'))
                        <form action="{{ route('experience.destroy', ['id' => $candidate->id, 'experience' => $exp->id]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"onclick="return confirm('Are you sure you want to delete this experience?');">Delete</button>
                        </form>
                        @endif
                        <hr>
                    @endforeach
                </div>
                <div>
                    <h3 class="mb-2">Achievement</h3>
                    @foreach ($achievements as $ach)
                       <p class="mb-0 text-sm" style="font-weight: bold;">{{ $ach->name }}</p>
                        <p class="mb-0 text-sm">{{ $ach->description }}</p>
                        <form action="{{ route('achievement.destroy', ['id' => $candidate->id, 'achievement' => $ach->id]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"onclick="return confirm('Are you sure you want to delete this achievement?');">Delete</button>
                        </form>
                        <hr>
                    @endforeach
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                    <a href="/admin/president-candidate" class="btn bg-gradient-info">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
