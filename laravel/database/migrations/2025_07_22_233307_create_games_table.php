<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('genre')->nullable();
            $table->date('release_date')->nullable();
            $table->string('image')->nullable();
            $table->timestamps(); // created_at e updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove a tabela dependente primeiro para evitar erro de foreign key
        Schema::dropIfExists('game_images');
        Schema::dropIfExists('games');
    }
}
