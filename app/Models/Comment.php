<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $guarded = ["created_at" ,"updated_at" ];
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function author(){
        return $this->belongsTo(User::class,"user_id");
    }
}
