<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primaryusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_id')->nullable();
            $table->string('gmail')->nullable();
            $table->string('ctactnumber')->nullable();
            $table->string('guarnumber')->nullable();

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
        Schema::dropIfExists('primaryusers');
    }
}
