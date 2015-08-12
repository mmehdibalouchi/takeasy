<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elevels', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            // $table->timestamps();
        });

       // Schema::table('users', function ($table) { 
       //      $table->foreign('elevel_id')->references('id')->on('elevels'); 
       //  });
        DB::table('elevels')->insert(array(
            array('name' => 'Assistance degree Diploma'),
            array('name' => 'Bachelor degree'),
            array('name' => 'Master degree'),
            array('name' => 'P.H.D and above'),
            ));
 
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
        //     $table->dropForeign('elevel_id');
        // });

        Schema::drop('elevels');
    }
}
