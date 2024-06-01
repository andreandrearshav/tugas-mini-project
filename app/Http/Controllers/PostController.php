<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
// Import the Post model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function post(Request $request)
    {
        // Validate the request data
        $request->validate([
            'image' => 'required|image|max:2048',
            'caption' => 'required|max:255',
        ]);

        $imagePath = $request->file('image')->storeAs(
            'uploads', time() . '_' . $request->file('image')->getClientOriginalName(), 
            'public'
        );

        // dd($imagePath);
        Log::info('Image uploaded : ' . $imagePath);

        // Create a new post
        $post = new Post();
        $post->image = $imagePath;
        $post->caption = $request->caption;
        $post->user_id = Auth::id(); 
        $post->created_at=Carbon::now();
        $post->save();

        Log::info('Post created: ' . $post);
        return redirect()->route('home');
    }
    public function index()
    {
        
        // $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        // $usersToFollow = User::where('id', '!=', auth()->id())->get();
        // return view('home', compact('posts', 'usersToFollow'));
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        $users =User::all();
        return view('home',['posts'=>$posts,'users'=>$users]);
        // return view('home', compact('posts', 'users'));
    }

    public function like(Post $post)
    {
        $post->likes()->toggle(auth()->user()->id);
        return response()->json(['status' => 'success', 'message' => 'Liked successfully']);
    }

    public function comment(Request $request, Post $post)
    {
        $validated = $request->validate(['comment' => 'required|string']);
        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $validated['comment']
        ]);
        return response()->json(['status' => 'success', 'message' => 'Commented successfully']);
    }

    public function bookmark(Post $post)
    {
        auth()->user()->bookmarks()->toggle($post->id);
        return response()->json(['status' => 'success', 'message' => 'Bookmarked successfully']);
    }
    
}