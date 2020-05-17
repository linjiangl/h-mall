<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateStatisticsOrderTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistics_order', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('date', false, true)->comment('日期');
            $table->decimal('order_total_amount', 11, 2)->unsigned()->default(0)->comment('销售总金额');
            $table->decimal('order_paid_amount', 11, 2)->unsigned()->default(0)->comment('已支付金额');
            $table->decimal('order_unpaid_amount', 11, 2)->unsigned()->default(0)->comment('未支付金额');
            $table->decimal('order_canceled_amount', 11, 2)->unsigned()->default(0)->comment('已取消金额');
            $table->decimal('order_finished_amount', 11, 2)->unsigned()->default(0)->comment('已完成金额');
            $table->integer('order_total_user', false, true)->default(0)->comment('下单总人数');
            $table->integer('order_paid_user', false, true)->default(0)->comment('未支付下单人数');
            $table->integer('order_unpaid_user', false, true)->default(0)->comment('已支付下单人数');
            $table->integer('order_canceled_user', false, true)->default(0)->comment('已取消下单人数');
            $table->integer('order_finished_user', false, true)->default(0)->comment('已完成下单人数');
            $table->integer('order_total_number', false, true)->default(0)->comment('订单总数');
            $table->integer('order_paid_number', false, true)->default(0)->comment('未支付订单数量');
            $table->integer('order_unpaid_number', false, true)->default(0)->comment('已支付订单数量');
            $table->integer('order_canceled_number', false, true)->default(0)->comment('已取消订单数量');
            $table->integer('order_finished_number', false, true)->default(0)->comment('已完成订单数量');
            $table->integer('order_total_quantity', false, true)->default(0)->comment('订单商品个数');
            $table->integer('order_paid_quantity', false, true)->default(0)->comment('未支付商品个数');
            $table->integer('order_unpaid_quantity', false, true)->default(0)->comment('已支付商品个数');
            $table->integer('order_canceled_quantity', false, true)->default(0)->comment('已取消商品个数');
            $table->integer('order_finished_quantity', false, true)->default(0)->comment('已完成商品个数');
            $table->integer('order_total_spu', false, true)->default(0)->comment('订单商品总件数');
            $table->integer('order_paid_spu', false, true)->default(0)->comment('未支付商品件数');
            $table->integer('order_unpaid_spu', false, true)->default(0)->comment('已支付商品件数');
            $table->integer('order_canceled_spu', false, true)->default(0)->comment('已取消商品件数');
            $table->integer('order_finished_spu', false, true)->default(0)->comment('已完成商品件数');
            $table->integer('order_total_sku', false, true)->default(0)->comment('订单商品属性总件数');
            $table->integer('order_paid_sku', false, true)->default(0)->comment('未支付商品属性件数');
            $table->integer('order_unpaid_sku', false, true)->default(0)->comment('已支付商品属性件数');
            $table->integer('order_canceled_sku', false, true)->default(0)->comment('已取消商品属性件数');
            $table->integer('order_finished_sku', false, true)->default(0)->comment('已完成商品属性件数');
            $table->timestamps();

            $table->unique(['date'], 'date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics_order');
    }
}
