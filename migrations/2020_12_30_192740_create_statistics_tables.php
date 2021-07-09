<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateStatisticsTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistics_order', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('date')->comment('日期');
            $table->decimal('order_total_amount', 11, 2)->unsigned()->default(0)->comment('销售总金额');
            $table->decimal('order_paid_amount', 11, 2)->unsigned()->default(0)->comment('已支付金额');
            $table->decimal('order_unpaid_amount', 11, 2)->unsigned()->default(0)->comment('未支付金额');
            $table->decimal('order_canceled_amount', 11, 2)->unsigned()->default(0)->comment('已取消金额');
            $table->decimal('order_finished_amount', 11, 2)->unsigned()->default(0)->comment('已完成金额');
            $table->unsignedInteger('order_total_user')->default(0)->comment('下单总人数');
            $table->unsignedInteger('order_paid_user')->default(0)->comment('未支付下单人数');
            $table->unsignedInteger('order_unpaid_user')->default(0)->comment('已支付下单人数');
            $table->unsignedInteger('order_canceled_user')->default(0)->comment('已取消下单人数');
            $table->unsignedInteger('order_finished_user')->default(0)->comment('已完成下单人数');
            $table->unsignedInteger('order_total_number')->default(0)->comment('订单总数');
            $table->unsignedInteger('order_paid_number')->default(0)->comment('未支付订单数量');
            $table->unsignedInteger('order_unpaid_number')->default(0)->comment('已支付订单数量');
            $table->unsignedInteger('order_canceled_number')->default(0)->comment('已取消订单数量');
            $table->unsignedInteger('order_finished_number')->default(0)->comment('已完成订单数量');
            $table->unsignedInteger('order_total_quantity')->default(0)->comment('订单商品个数');
            $table->unsignedInteger('order_paid_quantity')->default(0)->comment('未支付商品个数');
            $table->unsignedInteger('order_unpaid_quantity')->default(0)->comment('已支付商品个数');
            $table->unsignedInteger('order_canceled_quantity')->default(0)->comment('已取消商品个数');
            $table->unsignedInteger('order_finished_quantity')->default(0)->comment('已完成商品个数');
            $table->unsignedInteger('order_total_spu')->default(0)->comment('订单商品总件数');
            $table->unsignedInteger('order_paid_spu')->default(0)->comment('未支付商品件数');
            $table->unsignedInteger('order_unpaid_spu')->default(0)->comment('已支付商品件数');
            $table->unsignedInteger('order_canceled_spu')->default(0)->comment('已取消商品件数');
            $table->unsignedInteger('order_finished_spu')->default(0)->comment('已完成商品件数');
            $table->unsignedInteger('order_total_sku')->default(0)->comment('订单商品属性总件数');
            $table->unsignedInteger('order_paid_sku')->default(0)->comment('未支付商品属性件数');
            $table->unsignedInteger('order_unpaid_sku')->default(0)->comment('已支付商品属性件数');
            $table->unsignedInteger('order_canceled_sku')->default(0)->comment('已取消商品属性件数');
            $table->unsignedInteger('order_finished_sku')->default(0)->comment('已完成商品属性件数');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['date'], 'date');
        });

        create_table_comment('statistics_order', '统计-订单');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics_order');
    }
}
