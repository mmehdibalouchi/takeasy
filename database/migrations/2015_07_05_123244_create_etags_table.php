<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
//            $table->enum('level', [''])
            //level
            $table->timestamps();
        });

        Schema::create('etags_users', function (Blueprint $table){

            $table->integer('user_id')->unsigned()->index();
            $table->integer('etag_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('etag_id')->references('id')->on('etags')->onDelete('cascade');

            $table->unique(['user_id', 'etag_id']);
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
        Schema::drop('etags_users');
        Schema::drop('etags');
    }
}
