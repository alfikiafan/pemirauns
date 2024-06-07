@extends('layouts.app')

@section('content')
<div class="card mx-3 mb-3">
    <div class="card-header pb-3">
        <h6 class="m-0">Create Information</h6>
        <p class="m-0">Create new information</p>
    </div>
    <div class="card-body pt-0">
        <form action="{{ route('admin.information.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
            </div>

            <div class="mb-3">
                <label for="publish_date" class="form-label">Publish Date</label>
                <input type="date" class="form-control" id="publish_date" name="publish_date" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.information.index') }}" class="btn bg-gradient-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
