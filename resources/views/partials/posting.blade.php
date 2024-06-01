@extends('layouts.main')

@section('post')
<div class="container-fluid d-flex align-items-center justify-content-center vh-80">
    <div class="row justify-content-center w-50">
        <div class="container">
            <div class="row">
                <h3 class="text-center">Gambar</h3>
                <div class="mt-4 text-center mb-4">
                    <a href="#" class="me-3 text-decoration-none text-white">For you</a>
                    <a href="#" class="text-decoration-none text-white">Following</a>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="mb-3 mt-2">
                                <h5>pesertamsib</h5>
                            </div>
                            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="caption" class="form-label">Caption</label>
                                    <textarea class="form-control" id="caption" name="caption" rows="3" placeholder="Tambahkan keterangan..." required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="imageUpload" class="form-label">Pilih gambar</label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Posting</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
