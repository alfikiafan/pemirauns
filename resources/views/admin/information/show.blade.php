@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6 class="m-0">Information Details</h6>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $information->title }}</h5>
            <p class="card-text">{{ $information->content }}</p>
            <p class="card-text"><strong>Publish Date:</strong> {{ $information->publish_date }}</p>
            <p class="card-text"><strong>Last Updated:</strong> {{ $information->updated_at }}</p>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <a href="{{ route('admin.information.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection
