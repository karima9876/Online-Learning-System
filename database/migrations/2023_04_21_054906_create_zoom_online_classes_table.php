<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomOnlineClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_online_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('host_user_id');
            $table->text('topic');
            $table->dateTime('start_time');
            $table->unsignedInteger('duration')->comment('In minutes');
            $table->string('course_code');
            $table->string('course_title');
            $table->integer('category_id');
            $table->string('year_session');
            $table->string('meeting_id')->nullable();
            $table->string('meeting_password')->nullable();
            $table->string('join_url')->nullable();

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
        Schema::dropIfExists('zoom_online_classes');
    }
}
