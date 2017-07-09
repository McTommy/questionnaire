<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCacheBlanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache_blanks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('questionnaire_id')->index()->comment('调查问卷问题id');
            $table->unsignedInteger('respondent_id')->index()->comment('被调查者id');
            $table->unsignedInteger('question_id')->index()->comment('问题id');
            $table->string('content')->index()->comment('填空题答案内容');
            $table->unsignedInteger('order')->default(1)->comment('填空题答案序号');
            $table->string('cookie')->index()->comment('暂存问题唯一识别字段');
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
        Schema::dropIfExists('cache_blanks');
    }
}
