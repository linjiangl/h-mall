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

class CreateRefundTable extends Migration
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
            $table->string('order_status', 30);
            $table->string('service_type', 30)->comment('服务类型 money:仅退款, all:退货退款');
            $table->tinyInteger('express_status')->default(1)->comment('物流状态 1:未收货, 2:已收货');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('退款金额');
            $table->string('reason', 255)->comment('退款原因');
            $table->tinyInteger('status', false, true)->default(0)->comment('退款状态');
            $table->timestamp('applied_at')->nullable()->comment('用户申请退款时间');
            $table->timestamp('edited_at')->nullable()->comment('用户修改退款订单时间');
            $table->timestamp('canceled_at')->nullable()->comment('用户撤销退款时间');
            $table->timestamp('refused_at')->nullable()->comment('商家拒绝退款时间');
            $table->timestamp('agreed_at')->nullable()->comment('商家同意退款时间');
            $table->timestamp('shipped_at')->nullable()->comment('用户退款发货时间');
            $table->timestamp('received_at')->nullable()->comment('商家确认收货时间');
            $table->timestamp('finished_at')->nullable()->comment('退款成功时间');
            $table->timestamp('failed_at')->nullable()->comment('退款失败时间');
            $table->string('address', 1000)->default('')->comment('收货地址');
            $table->string('proofs', 1000)->default('')->comment('退款凭证');
            $table->string('remark', 255)->default('');
            $table->timestamps();

            $table->unique(['refund_sn'], 'refund_sn');
            $table->index(['user_id', 'status'], 'user_id_status');
            $table->index(['shop_id', 'status'], 'shop_id_status');
            $table->index(['order_id'], 'order_id');
            $table->index(['order_sn'], 'order_sn');
            $table->index(['status'], 'status');
            $table->index(['created_at'], 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund');
    }
}
