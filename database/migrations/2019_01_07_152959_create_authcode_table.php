<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authcode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->comment('手机号');
            $table->unsignedInteger('code')->comment('验证码');
            $table->unsignedTinyInteger('status')->default(0)->comment('使用状态 0：未使用 1：已使用 2：不可用');
            $table->unsignedTinyInteger('type')->comment('用途 1：登录 2：注册');
            $table->timestamp('over_time')->comment('过期时间');
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
        Schema::drop('authcode');
    }
}
