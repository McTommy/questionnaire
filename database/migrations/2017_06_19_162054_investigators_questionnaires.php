<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestigatorsQuestionnaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigator_questionnaire', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('investigator_id')->index();
            $table->unsignedInteger('questionnaire_id')->index();
            $table->foreign('investigator_id')->references('id')->on('investigators')->onDelete('cascade');
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('cascade');

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
        Schema::dropIfExists('investigator_questionnaire');
    }
}
