<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\reply;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function comment(Post $post)
    {
        $comments = $post->comments()->with('user', 'replies.user')->get();
        return view('partials.comments', compact('post', 'comments', ));
    }

   public function store(Request $request, Post $post)
   {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return redirect()->route('comments', $post->id)->with('success', 'Comment created successfully');
   }

   public function reply(Request $request, Comment $comment)
   {
        $request->validate([
            'content' => 'required|max:255',
        ]);
        Comment::create([
            'post_id' => $comment->post_id,
            'user_id' => auth()->id(),
            'parent_id' => $comment->id,
            'content' => $request->content,
        ]);
        // $reply = new reply();
        // $reply->comment_id = $comment->id;
        // $reply->user_id = auth()->id();
        // $reply->content = $request->content;
        // $reply->save();
        return redirect()->route('comments', $comment->post_id)->with('success', 'Comment created successfully');
   }

   public function destroy(Comment $comment)
   {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
   }
}
