<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iep', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('student_id');
          $table->string('case_manager');
          $table->boolean('is_active')->default(false);
          $table->timestamp('activated_at')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iep');
    }
}
