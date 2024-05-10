@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ __('Login') }}</h5>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" name="email" class=" mt-2 mb-3 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" class="mt-2 mb-3 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn mt-2" style="color:white; background-color:#005066">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
