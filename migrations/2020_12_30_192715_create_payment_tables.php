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

class CreatePaymentTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('order_ids', 255);
            $table->string('business_no', 64)->comment('支付业务号');
            $table->string('payment_method', 20)->comment('支付方式');
            $table->string('trade_no', 64)->default('')->comment('第三方支付流水号');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->tinyInteger('status')->default(0)->comment('支付状态 -1:已删除, 0:待支付, 1:支付成功, 2:重复支付退款');
            $table->string('remark', 3000)->default('');
            $table->integer('finished_time', false, true)->default(0)->comment('支付完成的时间');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['business_no'], 'business_no');
            $table->index(['trade_no'], 'trade_no');
            $table->index(['order_ids'], 'order_ids');
        });

        Schema::create('payment_refund', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('order_id', false, true);
            $table->integer('refund_id', false, true);
            $table->string('payment_business_no', 64)->comment('支付业务号');
            $table->string('business_no', 64)->comment('退款业务号');
            $table->string('refund_method', 20)->comment('退款方式');
            $table->string('trade_no', 64)->default('')->comment('第三方退款流水号');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->tinyInteger('status')->default(0)->comment('退款状态 -1:已删除, 0:未处理, 1:已处理');
            $table->string('remark', 3000)->default('');
            $table->integer('finished_time', false, true)->default(0)->comment('退款成功时间');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['business_no'], 'business_no');
            $table->index(['trade_no'], 'trade_no');
            $table->index(['payment_business_no'], 'payment_business_no');
            $table->index(['order_id'], 'order_id');
            $table->index(['refund_id'], 'refund_id');
        });

        Db::statement("ALTER TABLE `payment` COMMENT '支付记录'");
        Db::statement("ALTER TABLE `payment_refund` COMMENT '支付退款记录'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
        Schema::dropIfExists('payment_refund');
    }
}
