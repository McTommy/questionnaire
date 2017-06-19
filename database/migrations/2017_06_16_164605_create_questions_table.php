<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('questionnaire_id')->index()->comment('调查问卷id');
            $table->string('name')->index()->comment('问题名称');
            $table->unsignedInteger('type')->comment('问题类型,1-5以此为单选题 多选题 填空题 矩阵单选题 矩阵量表题');
            $table->unsignedInteger('order')->comment('问题序号');
            $table->unsignedInteger('maximum_option')->nullable()->comment('多选题最大可选项');
            $table->unsignedTinyInteger('is_respondent_info')->nullable()->comment('该问题是否为受访者个人信息');
            $table->unsignedInteger('parent_order')->nullable()->comment('父问题序号, 用于矩阵题');
            $table->unsignedTinyInteger('is_required')->default(1)->comment('是否必填, 默认必填');
            $table->unsignedTinyInteger('is_phone_number')->nullable()->comment('是否为手机号问题');
            $table->unsignedSmallInteger('status')->default(1)->comment('问题状态,默认为1');
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
        Schema::dropIfExists('questions');
    }
}
