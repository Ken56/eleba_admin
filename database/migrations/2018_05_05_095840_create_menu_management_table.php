<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->conment('菜单名称');
            $table->string('menu_route')->conment('路由');
            $table->integer('sorting')->conment('排序');
            $table->integer('parent_id')->default(0)->conment('父级ID');
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
        Schema::dropIfExists('menu_management');
    }
}
