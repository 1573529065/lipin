<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ub_id')->comment('采购者用户ub_id');
            $table->string('product_name', 50)->comment('产品名');
            $table->string('province', 20)->comment('需求省');
            $table->string('city', 20)->comment('需求市');
            $table->string('area', 20)->comment('需求区，县');
            $table->integer('price')->comment('解锁采购需要金币数');
            $table->timestamp('push_at')->comment('发布时间');
            $table->timestamp('expire_at')->comment('过期时间');
            $table->test('detail')->comment('采购信息详情');
            $table->unsignedInteger('pay_num')->comment('付费查看次数');

            $table->index('ub_id');
            $table->index('province');
            $table->index('city');
            $table->index('area');

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
        Schema::drop('purchases');
    }
}
