<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentCreatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_creates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('topic');
            $table->text('description')->nullable();
            $table->string('course_code');
            $table->string('course_title');
            $table->integer('category_id');
            $table->string('year_session');
            $table->dateTime('end_time');
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
        Schema::dropIfExists('assignment_creates');
    }
}
