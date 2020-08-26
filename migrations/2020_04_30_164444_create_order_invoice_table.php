<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateOrderInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_invoice', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->integer('order_id', false, true);
            $table->string('order_sn', 64);
            $table->tinyInteger('open_type', false, true)->comment('开具类型');
            $table->tinyInteger('type', false, true)->comment('发票类型');
            $table->string('title', 150)->comment('发票抬头');
            $table->string('taxpayer_id', 30)->comment('纳税人识别号');
            $table->tinyInteger('status', false, true)->default(0)->comment('状态 0:已申请, 1:待处理, 2:已处理');
            $table->string('invoice_src', 255)->comment('发票地址');
            $table->string('refused_reason', 255)->default('')->comment('拒绝理由');
            $table->text('invoice')->comment('发票内容');
            $table->timestamps();

            $table->index(['shop_id'], 'shop_id');
            $table->index(['user_id', 'status'], 'user_id_status');
            $table->index(['order_id'], 'order_id');
            $table->index(['order_sn'], 'order_sn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_invoice');
    }
}
