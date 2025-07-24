<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameImagesTable extends Migration
{
    public function up()
    {
        Schema::create('game_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_id');
            $table->string('image');
            $table->timestamps();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_images');
    }
}

