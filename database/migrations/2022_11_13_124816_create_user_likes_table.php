<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //post_user naming willnot fit with tbale purpose
        Schema::create('user_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("post_id")->references("id")->on("posts")->cascadeOnDelete() ;
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_likes');
    }
}
