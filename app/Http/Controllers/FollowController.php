<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        
        $userId = auth()->id(); 
        $followedId =$user->id;
        $followerId = $userId;
       $result= DB::table('followers')->insert([
            'user_id' => $userId,
            'followed_id' => $followedId,
            'follower_id' => $followerId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($result) {
            return Response()->json(['status' => 'success', 'message' => 'Followed successfully']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Failed to follow']);
        }
        
    }
}
