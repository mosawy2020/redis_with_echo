<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    protected $guarded = ["created_at", "updated_at"];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }


    public function authLiked()
    {
        return \auth()->user()->likes()->where("post_id", $this->id)->first() !== null;
    }
    public function likes()
    {
        return $this->hasMany(Like::class)->where("post_id",$this->id) ;
    }


}
