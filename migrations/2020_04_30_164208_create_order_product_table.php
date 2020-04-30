<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
}
