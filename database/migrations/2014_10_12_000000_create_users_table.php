<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('u_id')->comment('用户主键id');
            $table->string('u_name')->comment('用户名');
            $table->string('u_phone',20)->comment('用户手机号');
            $table->string('u_pass')->comment('登录密码');
            $table->integer('r_id')->unsigned()->comment('角色id');
            $table->string('last_ip')->comment('最后一次登录ip');
            $table->index('u_id');
            $table->index('u_phone');
            $table->rememberToken();
            $table->timestamps();
//            $table->comment('后台用户表');
        });
        Schema::create('auth', function (Blueprint $table) {
            $table->increments('a_id')->comment('权限id');
            $table->string('a_name')->comment('权限名称');
            $table->integer('a_pid')->unsigned()->comment('父id');
            $table->string('a_con',50)->comment('控制器');
            $table->string('a_act',50)->comment('操作方法');
            $table->string('a_path',20)->comment('全路径:c-a');
            $table->tinyInteger('a_level')->comment('级别');
            $table->index('a_id');
            $table->timestamps();
//            $table->comment('后台权限表');
        });
        Schema::create('role', function (Blueprint $table) {
            $table->increments('r_id')->comment('角色id');
            $table->string('r_name')->comment('角色名称');
            $table->string('r_desc')->comment('角色描述');
            $table->string('r_ids')->comment('权限id,逗号分隔');
            $table->text('r_auth_act')->comment('控制器-方法');
            $table->index('r_id');
            $table->timestamps();
//            $table->comment('后台角色表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('users');
    }
}
