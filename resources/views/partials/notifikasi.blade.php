@extends('layouts.main')

@section('content')
<style>
    .nav-link.active {
        border-bottom: 2px solid greenyellow;
    }
    .nav-link {
        transition: opacity 0.3s ease;
    }

    .active-link {
        opacity: 0.5;
    }
</style>
<div class="container mt-4">
    <h3 class="text-center mb-4">Notifikasi</h3>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <a href="#" class="nav-link text-decoration-none text-white" data-content="notifikasi-content">Semua</a>
                        <div class="row justify-content-center mt-1">
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="#" class="nav-link text-decoration-none text-white" data-content="komentar-content">Komentar</a>
                    </div>
                    <div class="col">
                        <a href="#" class="nav-link text-decoration-none text-white" data-content="disukai-content">Disukai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div id="notifikasi-content" class="content active">
                @foreach(auth()->user()->following as $followedUser)
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ $followedUser->profile_image ? asset('storage/' . $followedUser->profile_image) : asset('img/profile.png') }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="Profile Image">
                        <div>
                            <p class="fw-bold mb-0" href="{{ route('profile', $followedUser->id) }}">{{ $followedUser->name }}</p>
                            <p>{{ $followedUser->profile }} sudah mengikuti Anda.</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="komentar-content" class="content" style="display: none;">
                @if ($noPosts)
                @dd($yourPosts);
                    <p>Tidak ada postingan yang dikomentari</p>
                @else
                @foreach($yourPosts as $post)
                    <div class="mb-4">
                        @foreach($post->comments as $comment)
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ $comment->user->profile_image ? asset('storage/' . $comment->user->profile_image) : asset('img/profile.png') }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="Profile Image">
                                <div>
                                    <p class="fw-bold mb-0" href="{{ route('profile', $comment->user->id) }}">{{ $comment->user->name }}</p>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                
                @endif
            </div>
            {{-- <div id="komentar-content" class="content" style="display: none;">
                <p>Ini adalah konten Komentar.</p>
            </div> --}}
            <div id="disukai-content" class="content" style="display: none;">
                <p>Ini adalah konten Disukai.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.nav-link');
        const contents = document.querySelectorAll('.content');

        navLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                // Hide all content
                contents.forEach(content => content.style.display = 'none');

                // Show the selected content
                const contentId = this.getAttribute('data-content');
                document.getElementById(contentId).style.display = 'block';

                // Remove active class from all links
                navLinks.forEach(link => link.classList.remove('active'));

                // Add active class to the clicked link
                this.classList.add('active');

                // Remove active class from all content rows
                contents.forEach(content => content.classList.remove('active-row'));

                // Add active class to the row below the clicked link
                this.parentNode.nextElementSibling.firstElementChild.classList.add('active-row');
            });
        });
    });
</script>

@endsection
