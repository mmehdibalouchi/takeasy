<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olevels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level');
            $table->timestamps();
        });

       // Schema::table('users', function ($table) 
       // { 
       //      $table->foreign('olevel_id')->references('id')->on('olevels'); 
       //  });
 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function ($table) 
        // {
        //     $table->dropForeign('olevel_id');
        // });

        Schema::drop('olevels');
    }
}
