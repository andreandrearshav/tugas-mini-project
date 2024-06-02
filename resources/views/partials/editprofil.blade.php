@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="justify-content-center text-center mb-3">
                    <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('img/profile.png') }}" id="profile-image" class="mx-5 border border-dark rounded-circle" style="height: 90px; width: 90px; cursor: pointer;" alt="Profile Picture" onclick="document.getElementById('profile-image-input').click();">
                </div>
                <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" id="profile-image-input" name="profile_image" style="display: none;" accept="image/*" onchange="previewImage(event)">
                    
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', auth()->user()->bio) }}</textarea>
                    </div>

                    <div class="form-group mb-0 text-end">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('profile-image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
