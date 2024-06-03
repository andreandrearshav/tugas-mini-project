<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function explore(Request $request)
    {
        $authUser = Auth::user();
        $query = $request->input('search');
        
        $usersToFollow = User::whereDoesntHave('followers', function ($query) use ($authUser) {
            $query->where('follower_id', $authUser->id);
        })->where('id', '!=', $authUser->id);

        if ($query) {
            $usersToFollow->where('name', 'like', '%' . $query . '%');
        }

        $usersToFollow = $usersToFollow->get();
        $searchedUsers =User::where('name', 'like', '%' . $query . '%')
        
        ->where('id', '!=', $authUser->id)
        ->get();

        return view('partials.explore', compact('usersToFollow', 'query', 'searchedUsers'));
    }
        // return view('partials.explore', compact('user'));
    
    
    public function post()
    {
        return view('partials.posting');
    }

    public function profile()
    {
        $user=Auth::user();
        return view('partials.profil', compact('user'));
    }

    public function editProfile()
    {
        return view('partials.editprofil');
    }

    public function updateProfile(Request $request)
    {
        // return view('partials.editprofil');
        $request->validate([
            'username'=>'required|string|max: 255',
            'name'=>'required|string|max: 255',
            'bio'=>'nullable|string|max: 1000',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = Auth::user();

    if ($request->hasFile('profile_image')) {
        // Store the new profile image and delete the old one if necessary
        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->profile_image = $profileImagePath;
    }

            $user->username = $request->username;
            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully.');

    }

   
}
