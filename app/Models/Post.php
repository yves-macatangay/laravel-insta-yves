<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    //post belongs to user
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    //post has many category_posts
    public function categoryPosts(){
        return $this->hasMany(CategoryPost::class);
    }

    //Post has many Comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    //post has many likes
    public function likes(){
        return $this->hasMany(Like::class); //collection
    }

    //return TRUE if $this post is liked
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
        //$this->likes() - look at all likes of a post
        //where()... - in all the likes, which one has user_id of logged-in user?
        //exists() - if where() is found, return true
    }
}
