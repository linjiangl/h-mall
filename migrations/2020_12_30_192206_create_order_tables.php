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

class CreateOrderTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_sku_id');
            $table->unsignedInteger('quantity')->default(1)->comment('数量');
            $table->decimal('sale_price', 10)->unsigned()->comment('商品加入时价格');
            $table->unsignedTinyInteger('is_check')->default(0)->comment('是否选中 0:否, 1:是');
            $table->unsignedTinyInteger('is_buy_now')->default(0)->comment('立即购买 0:否, 1:是');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['user_id', 'product_sku_id'], 'user_id_product_sku_id');
            $table->index(['shop_id'], 'shop_id');

            $table->comment('购物车');
        });

        Schema::create('order', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('user_id');
            $table->string('order_no', 64)->comment('订单编号');
            $table->string('payment_method', 30)->default('')->comment('支付类型');
            $table->string('trade_no', 64)->default('')->comment('第三方支付流水号');
            $table->unsignedSmallInteger('buy_quantity')->default(0)->comment('购买总数量，累加商品购买数量');
            $table->unsignedSmallInteger('products_quantity')->default(0)->comment('商品总数量，订单中的商品数量');
            $table->decimal('products_amount', 11)->unsigned()->default(0)->comment('商品总金额');
            $table->decimal('total_amount', 11)->unsigned()->default(0)->comment('订单总金额');
            $table->decimal('express_amount', 6)->unsigned()->default(0)->comment('运费');
            $table->decimal('discount_amount', 7)->unsigned()->default(0)->comment('折扣金额');
            $table->string('consignee', 50)->comment('收件人');
            $table->string('mobile', 20)->comment('手机号');
            $table->string('province', 20)->comment('省');
            $table->string('city', 20)->comment('市');
            $table->string('district', 20)->comment('区');
            $table->string('street', 50)->default('')->comment('街道');
            $table->string('address', 150)->comment('收货地址');
            $table->string('zip_code', 20)->default('')->comment('邮政编码');
            $table->unsignedTinyInteger('is_dispatched')->default(0)->comment('是否需要发货');
            $table->unsignedTinyInteger('is_comment')->default(0)->comment('是否评论');
            $table->unsignedTinyInteger('is_additional')->default(0)->comment('是否追加评论');
            $table->unsignedTinyInteger('is_credited')->default(0)->comment('是否入账');
            $table->unsignedInteger('payment_time')->default(0)->comment('支付时间');
            $table->unsignedInteger('dispatched_time')->default(0)->comment('发货时间');
            $table->unsignedInteger('confirmed_time')->default(0)->comment('确认时间');
            $table->unsignedInteger('canceled_time')->comment('取消时间');
            $table->unsignedInteger('evaluate_time')->default(0)->comment('评论时间');
            $table->unsignedInteger('additional_evaluate_time')->default(0)->comment('追加评论时间');
            $table->smallInteger('status')->comment('订单状态');
            $table->string('buyer_message', 255)->default('')->comment('买家留言');
            $table->string('seller_message', 255)->default('')->comment('卖家留言');
            $table->string('refund_type', 30)->default('');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['order_no'], 'order_no');
            $table->index(['trade_no'], 'trade_no');
            $table->index(['mobile'], 'mobile');
            $table->index(['total_amount'], 'total_amount');
            $table->index(['shop_id', 'status'], 'shop_id');
            $table->index(['user_id', 'status'], 'user_id');
            $table->index(['created_time', 'status'], 'created_time');

            $table->comment('订单');
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_sku_id');
            $table->unsignedInteger('quantity')->comment('购买数量');
            $table->decimal('sale_price', 7)->unsigned()->comment('商品零售价');
            $table->decimal('pay_price', 7)->unsigned()->comment('支付单价');
            $table->decimal('product_amount', 11)->unsigned()->comment('商品总金额，数量 * 商品零售价 = 商品总金额');
            $table->decimal('discount_amount', 11)->unsigned()->comment('折扣金额，各种优惠/折扣的金额小计');
            $table->decimal('settlement_amount', 11)->unsigned()->comment('结算金额，订单实际支付金额');
            $table->decimal('surplus_refund_amount', 11)->unsigned()->comment('剩余的退款金额，默认结算金额');
            $table->string('refund_type', 30)->default('');
            $table->unsignedInteger('refund_id')->default(0);
            $table->unsignedTinyInteger('refund_status')->default(0);
            $table->string('sku_properties_name', 255)->comment('SKU的值。如：机身颜色:黑色;手机套餐:官方标配');
            $table->string('product_name', 255)->comment('商品名称');
            $table->text('product_memo')->comment('商品备注');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['order_id'], 'order_id');
            $table->index(['product_id'], 'product_id');
            $table->index(['product_sku_id'], 'product_sku_id');
            $table->index(['user_id', 'product_name'], 'user_id_product_name');

            $table->comment('订单商品');
        });

        Schema::create('order_express', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('order_id')->default(0);
            $table->unsignedInteger('refund_id')->default(0);
            $table->unsignedInteger('express_id');
            $table->string('express_name', 20)->comment('快递名称');
            $table->string('express_number', 64)->comment('快递单号');
            $table->decimal('amount', 6)->unsigned()->default(0)->comment('快递费');
            $table->integer('text_id')->default(0);
            $table->string('remark', 255)->default('');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['order_id'], 'order_id');
            $table->index(['refund_id'], 'refund_id');
            $table->index(['express_id'], 'express_id');
            $table->index(['express_number'], 'express_number');

            $table->comment('订单物流');
        });

        Schema::create('order_invoice', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->string('order_no', 64);
            $table->unsignedTinyInteger('open_type')->comment('开具类型');
            $table->unsignedTinyInteger('type')->comment('发票类型');
            $table->string('title', 150)->comment('发票抬头');
            $table->string('taxpayer_no', 30)->comment('纳税人识别号');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态 0:已申请, 1:待处理, 2:已处理');
            $table->string('invoice_url', 255)->comment('发票地址');
            $table->string('refused_reason', 255)->default('')->comment('拒绝理由');
            $table->text('invoice')->comment('发票内容');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['user_id'], 'user_id');
            $table->index(['order_id'], 'order_id');
            $table->index(['order_no'], 'order_no');

            $table->comment('订单发票');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_express');
        Schema::dropIfExists('order_invoice');
    }
}
