<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            //level :-?
            $table->timestamps();
        });

        Schema::create('otags_users', function(Blueprint $table){

            $table->integer('user_id')->unsigned()->index();
            $table->integer('otag_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('otag_id')->references('id')->on('otags')->onDelete('cascade');

            $table->unique(['user_id', 'otag_id']);
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
        Schema::drop('otags_users');
        Schema::drop('otags');
    }
}
