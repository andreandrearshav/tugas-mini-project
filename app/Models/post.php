<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','caption', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function followers()
    // {
    //     return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    // }
    
    // public function following()
    // {
    //     return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    // }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

}
