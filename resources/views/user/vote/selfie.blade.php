@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ __('Vote Photo') }}</h5>
                    <form action="{{ route('user.vote') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="camera-container">
                                <video id="camera-stream" width="320" height="240" autoplay></video>
                                <img id="captured-image" style="display: none;" width="320" height="240">
                            </div>
                            <button type="button" class="btn mt-2" id="capture-button">Capture</button>
                            <button type="button" class="btn btn-secondary mt-2" id="recapture-button"
                                style="display: none;">Recapture</button>
                            <input type="hidden" name="user_photo_data" id="user_photo_data" value="">
                        </div>

                        <div class="form-group mb-0">
                            <form action="{{ route('user.vote') }}" method="POST">
                                @csrf
                                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                <button type="submit" class="btn btn-primary w-100">VOTE</button>
                            </form>
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
        stream = await navigator.mediaDevices.getUserMedia({
            video: true
        });
        video.srcObject = stream;
    } catch (err) {
        console.error('Error accessing camera:', err);
        alert('Error accessing camera. Please ensure you have given permission.');
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