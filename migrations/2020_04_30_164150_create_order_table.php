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

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('buyer_id', false, true);
            $table->string('order_sn', 64)->comment('订单号');
            $table->string('payment_method', 30)->default('')->comment('支付类型');
            $table->string('payment_no', 64)->default('')->comment('第三方支付流水号');
            $table->decimal('product_amount', 10, 2)->unsigned()->default(0)->comment('商品总金额');
            $table->decimal('total_amount', 10, 2)->unsigned()->default(0)->comment('订单总金额');
            $table->decimal('express_amount', 6, 2)->unsigned()->default(0)->comment('运费');
            $table->decimal('discount_amount', 7, 2)->unsigned()->default(0)->comment('折扣金额');
            $table->string('consignee', 50)->comment('收件人');
            $table->string('mobile', 20)->comment('手机号');
            $table->string('province', 20)->comment('省');
            $table->string('city', 20)->comment('市');
            $table->string('district', 20)->comment('区');
            $table->string('street', 50)->default('')->comment('街道');
            $table->string('address', 150)->comment('收货地址');
            $table->string('zip_code', 20)->default('')->comment('邮政编码');
            $table->tinyInteger('is_dispatched', false, true)->default(0)->comment('是否需要发货');
            $table->tinyInteger('is_comment', false, true)->default(0)->comment('是否评论');
            $table->tinyInteger('is_additional', false, true)->default(0)->comment('是否追加评论');
            $table->tinyInteger('is_credited', false, true)->default(0)->comment('是否入账');
            $table->integer('payment_time', false, true)->default(0)->comment('支付时间');
            $table->integer('dispatched_time', false, true)->default(0)->comment('发货时间');
            $table->integer('confirmed_time', false, true)->default(0)->comment('确认时间');
            $table->integer('canceled_time', false, true)->default(0)->comment('取消时间');
            $table->integer('comment_time', false, true)->default(0)->comment('评论时间');
            $table->integer('additional_comment_time', false, true)->default(0)->comment('追加评论时间');
            $table->tinyInteger('status', false, true)->comment('订单状态');
            $table->string('buyer_message', 255)->default('')->comment('买家留言');
            $table->string('seller_message', 255)->default('')->comment('买家留言');
            $table->string('refund_type', 30)->default('');
            $table->timestamps();

            $table->unique(['order_sn'], 'order_sn');
            $table->index(['mobile'], 'mobile');
            $table->index(['payment_no'], 'payment_no');
            $table->index(['shop_id', 'status'], 'shop_id_status');
            $table->index(['buyer_id', 'status'], 'buyer_id_status');
            $table->index(['total_amount', 'status'], 'total_amount_status');
            $table->index(['status'], 'status');
            $table->index(['created_at'], 'created_at');

            $table->foreign('buyer_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
}
