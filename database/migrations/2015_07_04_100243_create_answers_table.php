<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('likes_num')->unsigned();
            $table->integer('dislikes_num')->unsigned();
            $table->text('content');
            $table->morphs('answerable');
            $table->timestamps();
            // $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unique(['user_id', 'question_id', 'content']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
