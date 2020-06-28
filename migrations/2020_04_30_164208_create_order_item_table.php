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

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('order_id', false, true);
            $table->integer('product_id', false, true);
            $table->integer('product_sku_id', false, true);
            $table->string('product_name', 255)->comment('商品名称');
            $table->string('product_sku_name', 255)->comment('商品属性名称');
            $table->smallInteger('quantity', false, true)->comment('数量');
            $table->decimal('total_amount', 10, 2)->unsigned()->default(0)->comment('商品总金额');
            $table->decimal('discount_amount', 10, 2)->unsigned()->default(0)->comment('折扣金额');
            $table->integer('refund_id', false, true)->default(0);
            $table->integer('refund_item_id', false, true)->default(0);
            $table->tinyInteger('refund_status', false, true)->default(0);
            $table->string('refund_type', 30)->default('');
            $table->string('remark', 255)->default('')->comment('备注');
            $table->timestamps();

            $table->unique(['order_id', 'product_sku_id'], 'order_id_product_sku_id');
            $table->index(['product_id'], 'product_id');
            $table->index(['product_name'], 'product_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
}
