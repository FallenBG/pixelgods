<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id');
            $table->text('title');
            $table->text('description');
            $table->text('genre')->nullable();
            $table->integer('max_participant')->nullable();
            $table->integer('chars_per_turn')->nullable();
            $table->integer('skip_step')->nullable();
            $table->integer('visible_history')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('public');
            $table->boolean('finished');
            $table->boolean('published');
            $table->boolean('deleted');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
