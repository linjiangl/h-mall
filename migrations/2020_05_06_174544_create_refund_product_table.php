<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateRefundProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refund_product', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('refund_id', false, true);
			$table->integer('order_id', false, true);
			$table->integer('order_product_id', false, true);
			$table->integer('product_id', false, true);
			$table->integer('product_sku_id', false, true);
			$table->decimal('amount', 10, 2)->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_product');
    }
}
