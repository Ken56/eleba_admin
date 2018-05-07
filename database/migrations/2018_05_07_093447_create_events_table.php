<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('活动标题');
            $table->text('contentx')->comment('活动类容');
            $table->integer('signup_start')->comment('开始时间');
            $table->integer('signup_end')->comment('结束时间');
            $table->date('prize_date')->comment('开奖日期');
            $table->integer('signup_num')->default(0)->comment('报名人数限制');
            $table->integer('is_prize')->default(0)->comment('是否已开奖 0未开奖 1已开奖');
            $table->timestamps();
            $table->engine='InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
