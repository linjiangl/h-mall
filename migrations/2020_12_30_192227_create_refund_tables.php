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
use Hyperf\DbConnection\Db;

class CreateRefundTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refund', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('shop_id', false, true);
            $table->integer('order_id', false, true);
            $table->string('refund_sn', 32);
            $table->string('order_sn', 32);
            $table->tinyInteger('order_status', false, true);
            $table->string('service_type', 30)->comment('服务类型 money:仅退款, all:退货退款');
            $table->tinyInteger('express_status')->default(1)->comment('物流状态 1:未收货, 2:已收货');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('退款金额');
            $table->string('reason', 255)->comment('退款原因');
            $table->smallInteger('status')->default(0)->comment('退款状态 -1:已删除');
            $table->integer('applied_time', false, true)->default(0)->comment('用户申请退款时间');
            $table->integer('edited_time', false, true)->default(0)->comment('用户修改退款订单时间');
            $table->integer('canceled_time', false, true)->default(0)->comment('用户撤销退款时间');
            $table->integer('refused_time', false, true)->default(0)->comment('商家拒绝退款时间');
            $table->integer('agreed_time', false, true)->default(0)->comment('商家同意退款时间');
            $table->integer('shipped_time', false, true)->default(0)->comment('用户退款发货时间');
            $table->integer('received_time', false, true)->default(0)->comment('商家确认收货时间');
            $table->integer('finished_time', false, true)->default(0)->comment('退款成功时间');
            $table->integer('failed_time', false, true)->default(0)->comment('退款失败时间');
            $table->string('address', 1000)->default('')->comment('收货地址');
            $table->string('proofs', 1000)->default('')->comment('退款凭证');
            $table->string('remark', 255)->default('');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['refund_sn'], 'refund_sn');
            $table->index(['user_id', 'status'], 'user_id_status');
            $table->index(['shop_id', 'status'], 'shop_id_status');
            $table->index(['order_id'], 'order_id');
            $table->index(['order_sn'], 'order_sn');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('refund_goods', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('refund_id', false, true);
            $table->integer('order_id', false, true);
            $table->integer('order_goods_id', false, true);
            $table->integer('goods_id', false, true);
            $table->integer('goods_sku_id', false, true);
            $table->decimal('amount', 10, 2)->unsigned()->default(0);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['refund_id', 'order_goods_id'], 'refund_id_order_goods_id');
            $table->index(['goods_id'], 'goods_id');
        });

        Schema::create('refund_action', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('refund_id', false, true);
            $table->integer('order_id', false, true);
            $table->integer('user_id', false, true);
            $table->integer('action_user_id', false, true)->default(0)->comment('操作用户 0:系统');
            $table->tinyInteger('refund_status', false, true)->comment('退款状态');
            $table->string('remark', 255)->default('');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['refund_id'], 'refund_id');
        });

        Db::statement("ALTER TABLE `refund` COMMENT '退款'");
        Db::statement("ALTER TABLE `refund_goods` COMMENT '退款商品'");
        Db::statement("ALTER TABLE `refund_action` COMMENT '退款操作'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund');
        Schema::dropIfExists('refund_goods');
        Schema::dropIfExists('refund_action');
    }
}
