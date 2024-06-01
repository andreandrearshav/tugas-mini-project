@extends('layouts.main')
@section('comments')
<div class="container">
    <div class="row justify-content-center">
        <h2 class="text-center mt-3">hallo</h2>
        <p><a class="text-decoration-none text-dark" href="{{ route('home') }}">Back</a></p>
    </div>

    <div class="col-md-11-lg-2 mt-3 mx-4 py-3">
        <div class="border rounded border-dark p-4 d-flex">
            <div class="col-md-9 pe-3">
                <div class="mb-4" style="width: 100%;">
                    <div class="profile mt-3 mb-3 d-flex align-items-center">
                        <div class="border border-dark rounded-circle" style="width: 40px; height: 40px; overflow: hidden;">
                            <img class="img-fluid" src="{{ asset('img/profile.png') }}" alt="">
                        </div>
                        <div class="profile-info ms-2 ">
                            <span class="d-block">{{ $post->user->name }}</span>
                        </div>
                    </div>
                    <span class="d-block mt-3">{{ $post->caption }}</span>
                    <img class="rounded card-img-top mt-3" style="width: 70%; height: auto; object-fit: cover;" src="{{ asset('storage/' . $post->image) }}" alt="...">
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between mt-3">
                            <li class="d-flex align-items-center w-100">
                                <a href="" class="text-decoration-none text-dark">
                                    <i data-feather="heart" class="me-2"></i>
                                    <span>Like</span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center w-100" style="margin-left: -350px">
                                <a href="" class="text-decoration-none text-dark">
                                    <i data-feather="message-circle" class="me-2"></i>
                                    <span>Comment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" style="margin-left: -80px">
                <div class="position-sticky">
                    <h2 class="text-center">Komentar</h2>
                    {{-- tampilkan comment --}}
                    <div class="mt-3 ms-3">
                        @foreach($comments as $comment)
                            <div class="p-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-circle" style="width: 50px; height: 40px; overflow: hidden;">
                                        <img class="img-fluid" src="{{ asset('img/profile.png') }}" alt="">
                                    </div>
                                    <div class="ms-3">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    {{-- Add Reply and Delete buttons/icons --}}
                                    <div class="comment-container d-flex justify-content-between align-items-center">
                                        {{-- <button class="btn btn-sm btn-link text-decoration-none mt-2" onclick="showReplyForm({{ $comment->id }})">Reply</button> --}}
                                        @if(auth()->user()->id == $comment->user_id)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-decoration-none text-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="comment-container d-flex justify-content-between align-items-center">
                                    <p class="mb-0">{{ $comment->content }}</p>
                                    <button class="btn btn-sm btn-link text-decoration-none mt-2" onclick="showReplyForm({{ $comment->id }})">Reply</button>
                                </div>
                                <div class="border border-dark"></div>
                                {{-- Reply Form --}}
                                <div id="replyForm{{ $comment->id }}" class="mt-3 ms-5" style="display: none;">
                                    <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="rounded-circle border border-dark" style="width: 50px; height: 30px; overflow: hidden;">
                                                <img class="img-fluid" src="{{ asset('img/profile.png') }}" alt="Profile Picture" style="width: 100%; height: 100%; ">
                                            </div>
                                            <div class="ms-2">
                                                <strong>{{ auth()->user()->name }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-floating g-col-6">
                                            <textarea class="form-control" name="content" placeholder="Your reply" style="height: 70px"></textarea>
                                            <label for="floatingTextarea">Your reply</label>
                                            <button type="submit" class="btn btn-sm btn-primary mt-2">Reply</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- Display replies --}}
                                <div class="mt-1 ms-7">
                                    @foreach($comment->replies as $reply)
                                        <div class="p-3 mb-3 ms-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border border-dark" style="width: 50px; height: 30px; overflow: hidden;">
                                                    <img class="img-fluid" src="{{ asset('img/profile.png') }}" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div class="ms-2">
                                                    <strong>{{ $reply->user->name }}</strong>
                                                    <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                </div>
                                                <div class="ms-auto">
                                                    @if(auth()->user()->id == $reply->user_id)
                                                        <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-link text-decoration-none text-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <p>{{ $reply->content }}</p>
                                            </div>
                                            <div class="border border-dark"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="list-unstyled">
                        <div class="profile-info ms-2"></div>
                        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                        @csrf
                        <div class="form-floating g-col-6">
                            <textarea class="form-control" name="content" placeholder="Leave a comment here" id="" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Comments</label>
                            <button type="submit" class="btn btn-link text-decoration-none mt-3">Kirim</button>
                        </div>
                        </form>
                        <li class="d-flex align-items-center w-100">
                            <a href="" class="text-decoration-none text-dark mt-3">
                                <i data-feather="heart" class="me-2"></i>
                                <span>Like</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function showReplyForm(commentId) {
        var form = document.getElementById('replyForm' + commentId);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>

<style>
    .img-fluid {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>
