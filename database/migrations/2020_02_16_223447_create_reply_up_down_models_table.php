<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyUpDownModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_up_down_models', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('ruserId');
            $table->bigInteger('ans_id');
            $table->bigInteger('rup');
            $table->bigInteger('rdown');
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
        Schema::dropIfExists('reply_up_down_models');
    }
}
