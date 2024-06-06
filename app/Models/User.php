<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function followers()
    {
        // return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function following()
    {
        // return $this->belongsToMany(User::class, 'followers', 'follower_id','followed_id' )->withTimestamps();
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks')->withTimestamps();
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }

    
}
