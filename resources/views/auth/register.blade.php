@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ __('Register') }}</h5>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class=" mb-2 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nim">{{ __('NIM') }}</label>
                            <input id="nim" type="text" class="mb-2 form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" name="nim" value="{{ old('nim') }}" required autocomplete="nim">
                            @error('nim')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="mb-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="mb-2 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="student_card">{{ __('Student Card Image') }}</label>
                            <div class="mt-2">
                                <input id="student_card" type="file" class="form-control-file mb-2{{ $errors->has('student_card') ? ' is-invalid' : '' }}" name="student_card" required>
                                @error('student_card')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_photo">{{ __('User Photo') }}</label>
                            <div class="camera-container">
                                <video id="camera-stream" width="320" height="240" autoplay></video>
                                <img id="captured-image" style="display: none;" width="320" height="240">
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="capture-button">Capture</button>
                            <button type="button" class="btn btn-secondary mt-2" id="recapture-button" style="display: none;">Recapture</button>
                            <input type="hidden" name="user_photo_data" id="user_photo_data" value="">
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn mt-2" style="color:white; background-color:#005066">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const video = document.getElementById('camera-stream');
    const captureButton = document.getElementById('capture-button');
    const recaptureButton = document.getElementById('recapture-button');
    const capturedImage = document.getElementById('captured-image');
    const userPhotoDataInput = document.getElementById('user_photo_data');
    let stream;

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        } catch (err) {
            console.error('Error accessing camera:', err);
        }
    }

    function captureImage() {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    const data = canvas.toDataURL('image/jpeg');

    userPhotoDataInput.value = data;

    capturedImage.src = data;
    capturedImage.style.display = 'block';
    
    stopCamera();
    captureButton.style.display = 'none';
    recaptureButton.style.display = 'inline-block';
}


    function recaptureImage() {
        capturedImage.style.display = 'none';
        userPhotoDataInput.value = '';
        startCamera();
        captureButton.style.display = 'inline-block';
        recaptureButton.style.display = 'none';
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
    }

    startCamera();

    captureButton.addEventListener('click', captureImage);
    recaptureButton.addEventListener('click', recaptureImage);
</script>
<style>
    .camera-container {
        position: relative;
        width: 320px;
        height: 240px;
    }
    #camera-stream,
    #captured-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
@endsection
