<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score');
            $table->string('name');
            $table->string('middlename');
            $table->string('family');
            $table->boolean('gender');  //male or female
            $table->boolean('status');  //single or married
            $table->string('email')->unique();
            $table->string('password', 60);
            // $table->integer('elevel_id')->unsigned();
            // $table->integer('olevel_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        // DB::table('users')->insert([
        //     'name' => 'mohammad',
        //     'middlename' => 'mehdi',
        //     'family' => 'balouchi',
        //     'gender' => true,
        //     'status' => true,
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('jjjjjj');
        //     'role_id' => 1,
        //     ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
