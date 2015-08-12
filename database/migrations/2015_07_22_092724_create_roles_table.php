<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->timestamps();
        });

        Schema::table('users' ,function($table)
        {
            $table->foreign('role_id')->references('id')->on('roles');
        });

        DB::table('roles')->insert(array(
            array('name' => 'guest'),
            array('name' => 'expert'),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('users', function(Blueprint $table) 
        {
            $table->dropForeign('users_role_id_foreign');
        });

        Schema::drop('roles');
    }
}
