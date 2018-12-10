<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserbaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userbase', function (Blueprint $table) {
            $table->increments('ub_id');
            $table->string('name', 50)->comment('用户名');
            $table->integer('gold_num')->comment('金币余额');
            $table->string('card_image')->comment('身份证图片');
            $table->tinyInteger('auth_status')->unsigned()->comment('身份认证状态 1未认证 2 认证中 3 认证失败 4 已认证');
            $table->tinyInteger('status')->unsigned()->comment('用户状态 1 正常 0冻结');
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
        Schema::drop('userbase');
    }
}
