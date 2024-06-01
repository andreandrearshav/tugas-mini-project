<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function user()
    {
        $isLoggedIn =Auth::check();

        if (!$isLoggedIn) {
            return view('user',['menuItems'=>['home','explore','login','profile']]);
        }else {
            return view('user', ['menuItems' => ['home', 'explore', 'notification', 'posting', 'bookmark', 'logout']]);
        }
        return view('home');
    }
    
    
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
    
        // $authUserId = Auth::id();//new
    
        $usersToFollow = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('followers', function($query) {
                $query->where('follower_id', Auth::id());
                // $query->where('follower_id', $authUserId);
            })->get();
        $users=User::where('id','!=',Auth::id())->get();
        // $authUser = Auth::user();
        return view('home', ['posts' => $posts, 'usersToFollow' => $usersToFollow, 'users'=>$users]);
        
        
        
        
        
        
        // return view('home', ['posts' => $posts, 'usersToFollow' => $usersToFollow]);
        // $posts = Post::with('user')->latest()->first();
        // return view('home',['posts'=>$posts]);
    }
  
    public function logout(Request $request)
    {
        $request->session()->invalidate();

        
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }



    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' =>'invalid credentials']);
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validateData =$request->validate([
            'name' =>'required|string|max:255',
            'username' =>'required|string|max:255|unique:users',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:3|confirmed',
        ]);
        $user = User::create([
            'username' =>$validateData['username'],
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' =>  bcrypt($validateData['password']),
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('username',$validateData['username']);
    }

    public function follow($userId)
{
    $user = User::find($userId); // Menggunakan $userId untuk mencari pengguna
    if($user) {
        $authUser = auth()->user(); // Mengambil pengguna yang sedang login

        // Memastikan pengguna tidak mengikuti dirinya sendiri
        if ($authUser->id !== $user->id) {
            // Memeriksa apakah pengguna sudah mengikuti pengguna lain
            if ($authUser->following()->where('followed_id', $userId)->exists()) {
                return redirect()->route('home')->with('error', 'You are already following this user');
            } else {
                
                // Melakukan tindakan mengikuti jika pengguna belum mengikuti pengguna lain
                // $authUser->following()->syncWithoutDetaching($userId);
                $authUser->following()->attach($userId,['user_id' => $authUser->id]);
                // $authUser->following()->attach($userId);
                return redirect()->route('home')->with('success', 'Followed successfully');
                // return redirect()->route('home')->with('success', 'Followed successfully');
            }
        } else {
            return redirect()->route('home')->with('error', 'You cannot follow yourself');
        }
    } else {
        // Jika pengguna tidak ditemukan
        return redirect()->route('home')->with('error', 'User not found');
    }
}



}
