<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->text('place_name');
            $table->text('slug');
            $table->text('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->bigInteger('user_created')->unsigned()->nullable();
            $table->foreign('user_created')->references('id')->on('users')->onDelete('cascade');
            $table->json('service')->nullable();
            $table->json('information')->nullable();
            $table->json('media')->nullable();
            $table->json('schedule')->nullable();
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
        Schema::dropIfExists('places');
    }
}
