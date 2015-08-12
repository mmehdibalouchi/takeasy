<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Field of education');
            $table->string('minor');
            $table->string('group 1');
            $table->string('group 2');
            $table->string('group 3');
            $table->string('group 4');
            $table->string('alaki');
            $table->string('alaki2');
            $table->string('alaki3');
            $table->string('alaki4');
            $table->string('alaki5');
            $table->string('alaki6');
            $table->string('alaki27');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('educations');
    }
}
