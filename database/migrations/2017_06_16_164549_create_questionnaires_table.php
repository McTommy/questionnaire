<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('问卷标题');
            $table->string('author')->nullable()->comment('问卷作者');
            $table->string('sub_title')->nullable()->index()->comment('问卷副标题');
            $table->timestamp('make_time')->nullable()->comment('问卷制作时间');
            $table->timestamp('start_time')->nullable()->comment('问卷开始时间');
            $table->timestamp('end_time')->nullable()->comment('问卷结束时间');
            $table->unsignedTinyInteger('is_template')->default(0)->comment('该问卷是否显示为模板');
            $table->unsignedTinyInteger('editable')->default(1)->comment('该问卷是否可编辑');
            $table->unsignedSmallInteger('status')->default(1)->comment('问卷状态');
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
        Schema::dropIfExists('questionnaires');
    }
}
