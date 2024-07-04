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
        <h6 class="m-0">Tambah Achievement {{ $user->name }}</h6>
        <p class="m-0">Tambah Achievement</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('achievement.store', $user->id) }}" method="POST" id="presidentForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="text" id="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ back() }}" class="btn bg-gradient-info">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectCandidate = document.getElementById('president_candidate_id');
        const inputFaculty = document.getElementById('faculty');

        function setInitialFaculty() {
            const selectedOption = selectCandidate.options[selectCandidate.selectedIndex];
            const faculty = selectedOption.getAttribute('data-faculty');

            inputFaculty.value = faculty;
        }

        setInitialFaculty();

        selectCandidate.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const faculty = selectedOption.getAttribute('data-faculty');

            inputFaculty.value = faculty;
        });
    });
</script>
@endsection
