<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

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
			$table->string('order_sn', 32)->comment('订单号');
			$table->decimal('product_amount', 10, 2)->unsigned()->default(0)->comment('商品总金额');
			$table->decimal('total_amount', 10, 2)->unsigned()->default(0)->comment('订单总金额');
			$table->decimal('express_amount', 6, 2)->unsigned()->default(0)->comment('运费');
			$table->decimal('discount_amount', 7, 2)->unsigned()->default(0)->comment('折扣金额');
			$table->tinyInteger('status', false, true)->comment('订单状态');
			$table->string('consignee', 50)->comment('收件人');
			$table->string('mobile', 20)->comment('手机号');
			$table->string('province', 20)->comment('省');
			$table->string('city', 20)->comment('市');
			$table->string('district', 20)->comment('区');
			$table->string('street', 50)->default('')->comment('街道');
			$table->string('address', 150)->comment('收货地址');
			$table->string('zip_code', 20)->default('')->comment('邮政编码');
			$table->string('payment_method', 30)->default('')->comment('支付类型');
			$table->string('payment_no', 64)->default('')->comment('第三方支付流水号');
			$table->timestamp('payment_at')->nullable()->comment('支付时间');
			$table->timestamp('dispatched_at')->nullable()->comment('发货时间');
			$table->timestamp('confirmed_at')->nullable()->comment('确认时间');
			$table->timestamp('canceled_at')->nullable()->comment('取消时间');
			$table->timestamp('comment_at')->nullable()->comment('评论时间');
			$table->timestamp('additional_comment_at')->nullable()->comment('追加评论时间');
			$table->tinyInteger('is_dispatched', false, true)->default(0)->comment('是否需要发货');
			$table->tinyInteger('is_comment', false, true)->default(0)->comment('是否评论');
			$table->tinyInteger('is_additional', false, true)->default(0)->comment('是否追加评论');
			$table->tinyInteger('is_credited', false, true)->default(0)->comment('是否入账');
			$table->string('refund_type', 30)->default('');
			$table->string('buyer_message', 255)->default('')->comment('买家留言');
			$table->string('seller_message', 255)->default('')->comment('买家留言');
			$table->timestamps();
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
