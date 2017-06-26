<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('questionnaire_id')->index()->comment('调查问卷问题id');
            $table->unsignedInteger('respondent_id')->index()->comment('被调查者id');
            $table->unsignedInteger('question_id')->index()->comment('问题id');
            $table->unsignedInteger('choice_id')->index()->comment('选项id');
            $table->string('other')->nullable()->index()->comment('选项中的其他内容');
            $table->string('multi_blank')->nullable()->index()->comment('多项填空题答案处');
            $table->unsignedSmallInteger('status')->default(1);
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
        Schema::dropIfExists('answers');
    }
}
