<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->bigInteger('slug_id')->unsigned();
            $table->foreign('slug_id')->references('id')->on('slug')->onDelete('cascade');
            $table->text('featured_image');
            $table->text('contents');
            $table->integer('status')->default(1);
            $table->integer('type')->default(1);
            $table->bigInteger('user_create')->unsigned();
            $table->foreign('user_create')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('place_id')->unsigned()->nullable();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
