<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('公司名');
            $table->string('province', 20)->comment('公司所在省');
            $table->string('city',20)->comment('公司所在市');
            $table->string('area',20)->comment('公司所在区');
            $table->string('address', 50)->comment('详细地址');
            $table->integer('b_id')->comment('经营模式ID');
            $table->string('contact_name', 50)->comment('联系人姓名');
            $table->string('contact_tel', 50)->comment('联系人手机号');
            $table->string('contact_wx', 50)->comment('联系人微信号');
            $table->integer('p_id')->comment('职务ID');
            $table->unsignedTinyInteger('approve')->comment('认证状态 1. 未认证 2. 认证中 3. 认证失败 4. 认证成功');
            $table->unsignedTinyInteger('status')->comment('1. 正常 0删除');
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
        Schema::table('company', function (Blueprint $table) {
            //
        });
    }
}
