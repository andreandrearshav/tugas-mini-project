@extends('layouts.main')
@section('content')
<style>
    .custom-link {
        position: relative;
        padding: 5px 0  ;
    }
    .hover-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .custom-link-active {
        position: relative;
    }
    .custom-link-active .hover-line {
        width: 100%;
    }
    
</style>


<div class="text-center">
    <img src="{{ asset('img/logo-medsos.png') }}" class="text-center" style="width: 50px">
</div>
<div class="mt-4 text-center position-sticky" style="margin-bottom: 40px">
    <a href="{{ route('home') }}" class="me-3 text-decoration-none text-white custom-link" data-target="for-you">For you</a>
    <a href="{{ route('following') }}" class="text-decoration-none text-white custom-link" data-target="following">Following</a>
    <div class="hover-line"></div>
</div>
<div class="row vh-100" style="overflow-y: auto;">
<div class="col-md-6 mt-5">
    <div class="row">
        @if ($posts ->count()>0)
            @foreach ($posts as $post)
            <div class="col-12 mt-3 px-4 py-3">
                <div class="card border border-dark mb-4 p-2 w-100">
                    <div class="profile mt-3 mb-0 d-flex align-items-center">
                        <div class="border border-dark rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                            {{-- @if (Auth::check()) --}}
                            @if ($post->user->profile_image)
                                
                            {{-- <img class="img-fluid" style="object-fit: cover" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('img/profile.png') }}" alt=""> --}}
                            <img class="img-fluid" style="object-fit: cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="">
                            @endif
                        </div>
                        <div class="profile-info ms-2">
                            <span class="d-block">{{ $post->user->name }}</span>
                        </div>
                    </div>
                    <small class="text- text-dark fs-10 mb-2 text-dark-50">{{ $post->created_at->diffForHumans() }}</small>
                    <span class="d-block fw-semibold">{{ $post->caption }}</span>
                    @if ($post->image)
                    <a href="{{ route('comments', $post->id) }}">
                        <img class="rounded card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="...">
                    </a>
                    <div class="border border-dark mt-4"></div>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li class="d-flex align-items-center w-100">
                                <a href="" class="text-decoration-none text-dark" data-post-id="{{ $post->id }}">
                                    <i data-feather="heart" class="me-2"></i>
                                    <span>Like</span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center w-100">
                                <a href="{{ route('comments', $post->id) }}" class="text-decoration-none text-dark" data-post-id="{{ $post->id }}">
                                    <i data-feather="message-circle" class="me-2"></i>
                                    <span>Comment</span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center w-100">
                                <a href="" class="text-decoration-none text-dark" data-post-id="{{ $post->id }}">
                                    <i data-feather="bookmark" class="me-2"></i>
                                    <span>Faforit</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <p class="text-center">No posts available.</p>
        @endif
    </div>
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const customLinks = document.querySelectorAll('.custom-link');
        const hoverLine = document.querySelector('.hover-line');

        function setActiveLink(link) {
            customLinks.forEach(link => link.classList.remove('custom-link-active'));
            link.classList.add('custom-link-active');

            const linkWidth = link.offsetWidth;
            const linkLeft = link.offsetLeft;

            hoverLine.style.width = `${linkWidth}px`;
            hoverLine.style.transform = `translateX(${linkLeft}px)`;
        }

        customLinks.forEach(link => {
            link.addEventListener('mouseover', function() {
                setActiveLink(this);
            });

            link.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveLink(this);

                const target = this.getAttribute('data-target');

                if (target === 'for-you') {
                    window.location.href = "{{ route('home') }}";
                } else if (target === 'following') {
                    window.location.href = "{{ route('following') }}";
                }
            });
        });

        // Set initial active link
        const initialActiveLink = document.querySelector('.custom-link[data-target="for-you"]');
        setActiveLink(initialActiveLink);
    });
</script> --}}




