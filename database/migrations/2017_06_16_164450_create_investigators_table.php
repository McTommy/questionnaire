<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestigatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->nullable()->comment('调查员工id，默认为0');
            $table->string('name')->nullable()->comment('调查人名字, 非空');
            $table->unsignedSmallInteger('status')->default(1)->comment('调查人状态，默认为1');
            $table->string('extra')->nullable()->comment('额外备用字段，默认为空');
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
        Schema::dropIfExists('investigators');
    }
}
