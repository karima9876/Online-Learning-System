<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('question_models', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('quserId');
            $table->string('qtitle')->nullable();
            $table->string('qcategoryname');
            $table->longText('qcontent');
            $table->string('ufile')->nullable();
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
        Schema::dropIfExists('question_models');
    }
}
