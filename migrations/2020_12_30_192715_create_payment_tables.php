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
            $table->unsignedInteger('user_id');
            $table->string('serial_no', 64)->comment('业务编号');
            $table->string('payment_method', 20)->comment('支付方式');
            $table->string('order_maps', 255);
            $table->string('trade_no', 64)->default('')->comment('第三方支付流水号');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('支付状态 0:待支付, 1:支付成功, 2:重复支付退款');
            $table->text('remark');
            $table->unsignedInteger('finished_time')->default(0)->comment('支付完成的时间');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['serial_no'], 'serial_no');
            $table->index(['order_maps'], 'order_maps');
            $table->index(['trade_no'], 'trade_no');
        });

        Schema::create('payment_refund', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('refund_id');
            $table->string('serial_no', 64)->comment('退款编号');
            $table->string('refund_method', 20)->comment('退款方式');
            $table->string('payment_serial_no', 64)->comment('支付业务号');
            $table->string('trade_no', 64)->default('')->comment('第三方退款流水号');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('退款状态 0:未处理, 1:已处理');
            $table->text('remark');
            $table->unsignedInteger('finished_time')->default(0)->comment('退款成功时间');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['serial_no'], 'serial_no');
            $table->index(['order_id'], 'order_id');
            $table->index(['refund_id'], 'refund_id');
            $table->index(['trade_no'], 'trade_no');
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
