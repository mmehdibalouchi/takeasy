<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('qowner_id')->unsigned();
            $table->integer('aowner_id')->unsigned();
            // $table->integer('likes_num')->unsigned();
            $table->foreign('qowner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('aowner_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('private_questions');
    }
}
