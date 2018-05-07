<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnevtPrizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enevt_prize', function (Blueprint $table) {
            $table->string('name')->comment('奖品名称');
            $table->text('description')->comment('奖品详情');
            $table->string('member_id')->default('')->comment('中奖商家账号id');
            $table->integer('events_id')->unsigned();
            $table->foreign('events_id')->references('id')->on('activities');
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
        Schema::dropIfExists('enevt_prize');
    }
}
