@extends('layouts.main')

@section('home')
<div class="container-fluid">
    <div class="text-center">
        <img src="{{ asset('img/logo-medsos.png') }}" class="text-center" style="width: 50px">
    </div>
    <div class="mt-4 text-center position-sticky" style="margin-bottom: 40px">
        <a href="{{ route('home') }}" class="me-3 text-decoration-none text-white">For you</a>
        <a href="#" class="text-decoration-none text-white">Following</a>
    </div>
    <div class="row vh-100" style="overflow-y: auto;">
        <!-- Main Content -->
        <div class="col-md-6 mt-5">
            <div class="row">
                @if ($posts && $posts->count())
                    @foreach ($posts as $post)
                    <div class="col-12 mt-3 px-4 py-3">
                        <div class="card border border-dark mb-4 p-2 w-100">
                            <div class="profile mt-3 mb-3 d-flex align-items-center">
                                <div class="border border-dark rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                                    @if (Auth::check())
                                        
                                    <img class="img-fluid" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('img/profile.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="profile-info ms-2">
                                    <span class="d-block">{{ $post->user->name }}</span>
                                </div>
                            </div>
                            <span class="d-block">{{ $post->caption }}</span>
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
                                        <a href="" class="text-decoration-none text-dark" data-post-id="{{ $post->id }}">
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
        
        <!-- Sidebar Content -->
        <div class="col-md-6 mt-5" >
            <div class="position-sticky mx-2 " style="top: 100px;">
                <h2>Siapa yang harus diikuti</h2>
                <ul class="list-unstyled">
                    @if(auth()->check())
                    @php
                        $followingUser= null; // Mendefinisikan variabel dengan nilai awal null
                            if (auth()->check()) {
                                $followingUser = auth()->user()->following()->pluck('followed_id')->toArray();
                            }
                    @endphp
                @endif
                    @foreach ($users as $user)
                        <li class="d-flex align-items-center mb-2">
                            @if ($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="Profile Image">
                            @else
                                <span>
                                    <img src="{{ asset('img/profile.png') }}" class="img-fluid border border-dark rounded-circle me-2" style="width: 50px; height: 50px;" alt="">
                                </span>
                            @endif
                            <div class="d-flex flex-column flex-grow-1">
                                <span>{{ $user->name }}</span>
                            </div>
                            @if (in_array($user->id, $followingUser))
                                <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                            @else
                            <span class="ms-auto">
                                <form action="{{ route('follow', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Follow</button>
                                </form>
                            </span>
                            @endif
                                
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
// document.addEventListener('DOMContentLoaded', function () {
//     document.querySelectorAll('.like-post').forEach(function (element) {
//         element.addEventListener('click', function (e) {
//             e.preventDefault();
//             const postId = this.dataset.postId;
//             fetch(`/posts/${postId}/like`, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 }
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === 'success') {
//                     this.classList.toggle('active');
//                     alert(data.message);
//                 }
//             })
//             .catch(error => console.error('Error:', error));
//         });
//     });

//     document.querySelectorAll('.comment-post').forEach(function (element) {
//         element.addEventListener('click', function (e) {
//             e.preventDefault();
//             const postId = this.dataset.postId;
//             const comment = prompt("Enter your comment:");
//             if (comment) {
//                 fetch(`/posts/${postId}/comment`, {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                     },
//                     body: JSON.stringify({ comment: comment })
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.status === 'success') {
//                         this.classList.toggle('commented');
//                         alert(data.message);
//                     }
//                 })
//                 .catch(error => console.error('Error:', error));
//             }
//         });
//     });

//     document.querySelectorAll('.bookmark-post').forEach(function (element) {
//         element.addEventListener('click', function (e) {
//             e.preventDefault();
//             const postId = this.dataset.postId;
//             fetch(`/posts/${postId}/bookmark`, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 }
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === 'success') {
//                     this.classList.toggle('bookmarked');
//                     alert(data.message);
//                 }
//             })
//             .catch(error => console.error('Error:', error));
//         });
//     });
// });
</script>
@endsection

                
                
