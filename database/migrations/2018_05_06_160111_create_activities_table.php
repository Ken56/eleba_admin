<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('活动标题');
            $table->text('content')->comment('活动类容');
            $table->integer('start')->comment('开始时间');
            $table->integer('end')->comment('结束时间');
            $table->integer('fabu')->comment('发布时间');
            $table->date('prize_date')->comment('开奖日期');
            $table->integer('signup_num')->comment('报名人数限制');
            $table->integer('is_prize')->default(0)->comment('是否已开奖 0未开奖 1已开奖');
            $table->engine='InnoDB';
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
        Schema::dropIfExists('activities');
    }
}
