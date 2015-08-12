<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qtags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->timestamps();
        });

        Schema::create('users_interests', function (Blueprint $table)
        {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('qtag_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('qtag_id')->references('id')->on('qtags')->onDelete('cascade');

            $table->unique(['user_id','qtag_id']);
            $table->timestamps();
        });

        // Schema::create('users_professionals', function(Blueprint $table){
        //     $table->integer('user_id')->unsigned()->index();
        //     $table->integer('qtag_id')->unsigned()->index();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('qtag_id')->references('id')->on('qtags')->onDelete('cascade');

        //     $table->unique(['user_id', 'qtag_id']);
        //     $table->timestamps();
        // });

        Schema::create('qtags_questions', function(Blueprint $table)
        {
            $table->integer('question_id')->unsigned()->index();
            $table->integer('qtag_id')->unsigned()->index();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('qtag_id')->references('id')->on('qtags')->onDelete('cascade');

            $table->unique(['question_id', 'qtag_id']);
            $table->timestamps();
        });

        //insert default Tags to qtags table
        DB::table('qtags')->insert([
            ['name' => 'Insurance'],
            ['name' => 'Health'],
            ['name' => 'Law & legal'],
            ['name' => 'Travel'],
            ['name' => 'Arts'],
            ['name' => 'Beauty & style'],
            ['name' => 'Consumer electronics'],
            ['name' => 'Property and real state'],
            ['name' => 'Food & drink'],
            ['name' => 'Business & finance'],
            ['name' => 'Fashion & clothes'],
            ['name' => 'Education'],
            ['name' => 'Computer & mobile'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qtags_questions');
        // Schema::drop('users_professionals');
        Schema::drop('users_interests');
        Schema::drop('qtags');
    }
}
