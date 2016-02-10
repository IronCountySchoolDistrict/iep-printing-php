<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iep_responses', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('iep_id')->unsigned();
          $table->foreign('iep_id')->references('id')->on('iep');
          $table->integer('response_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iep_responses');
    }
}
