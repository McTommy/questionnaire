<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TypeOfQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type')->comment('问卷类型');
            $table->string('en_name')->comment('问卷类型, 英文名');
            $table->string('cn_name')->comment('问卷类型, 中文名');
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
        Schema::dropIfExists('type_of_question');
    }
}
