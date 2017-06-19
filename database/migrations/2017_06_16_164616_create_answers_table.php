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
            $table->unsignedInteger('question_id')->index()->comment('问题id');
            $table->string('content')->index()->comment('答案描述');
            $table->unsignedInteger('next_question_order')->nullable()->comment('下一个问题的序号');
            $table->unsignedSmallInteger('order')->default(1)->comment('答案序号');
            $table->unsignedSmallInteger('status')->default(1)->comment('状态');
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
