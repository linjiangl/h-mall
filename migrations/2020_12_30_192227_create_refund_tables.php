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

class CreateRefundTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refund', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('order_id');
            $table->string('refund_no', 32);
            $table->string('order_no', 32);
            $table->unsignedTinyInteger('order_status');
            $table->string('service_type', 30)->comment('服务类型 money:仅退款, all:退货退款');
            $table->tinyInteger('express_status')->default(1)->comment('物流状态 1:未收货, 2:已收货');
            $table->decimal('amount', 11)->unsigned()->default(0)->comment('退款金额');
            $table->string('reason', 255)->comment('退款原因');
            $table->smallInteger('status')->default(0)->comment('退款状态');
            $table->unsignedInteger('applied_time')->default(0)->comment('用户申请退款时间');
            $table->unsignedInteger('edited_time')->default(0)->comment('用户修改退款订单时间');
            $table->unsignedInteger('canceled_time')->comment('用户撤销退款时间');
            $table->unsignedInteger('refused_time')->default(0)->comment('商家拒绝退款时间');
            $table->unsignedInteger('agreed_time')->default(0)->comment('商家同意退款时间');
            $table->unsignedInteger('shipped_time')->default(0)->comment('用户退款发货时间');
            $table->unsignedInteger('received_time')->default(0)->comment('商家确认收货时间');
            $table->unsignedInteger('finished_time')->default(0)->comment('退款成功时间');
            $table->unsignedInteger('failed_time')->default(0)->comment('退款失败时间');
            $table->string('address', 1000)->default('')->comment('收货地址');
            $table->string('proofs', 1000)->default('')->comment('退款凭证');
            $table->string('remark', 255)->default('');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['refund_no'], 'refund_no');
            $table->index(['order_id'], 'order_id');
            $table->index(['order_no'], 'order_no');
            $table->index(['user_id', 'status'], 'user_id');
            $table->index(['shop_id', 'status'], 'shop_id');
            $table->index(['created_time', 'status'], 'created_time');

            $table->comment('退款订单');
        });

        Schema::create('refund_products', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('refund_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('order_product_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_sku_id');
            $table->decimal('amount', 11)->unsigned()->default(0);
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['refund_id'], 'refund_id');

            $table->comment('退款商品');
        });

        Schema::create('refund_action', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('refund_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('action_user_id')->default(0)->comment('操作用户 0:系统');
            $table->unsignedTinyInteger('refund_status')->comment('退款状态');
            $table->string('remark', 255)->default('');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['refund_id'], 'refund_id');

            $table->comment('退款操作');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund');
        Schema::dropIfExists('refund_products');
        Schema::dropIfExists('refund_action');
    }
}
