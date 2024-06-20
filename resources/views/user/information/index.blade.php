@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h3>Information List</h3>
        </div>

        @foreach($informations as $information)
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="m-0">{{ $information->title }}</h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $information->title }}</h5>
                    <p class="card-text">{{ $information->content }}</p>
                    <p class="card-text"><strong>Publish Date:</strong> {{ $information->publish_date }}</p>
                    <p class="card-text"><strong>Last Updated:</strong> {{ $information->updated_at }}</p>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $informations->links() }}
        </div>
    </div>
</div>
@endsection