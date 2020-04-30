<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateOrderExpressTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_express', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('order_id', false, true);
			$table->integer('refund_id', false, true)->default(0);
			$table->integer('express_id', false, true);
			$table->string('express_name', 20)->comment('快递名称');
			$table->string('express_no', 64)->comment('快递单号');
			$table->decimal('amount', 6, 2)->unsigned()->default(0)->comment('快递费');
			$table->integer('text_id')->default(0);
			$table->string('remark', 255)->default('');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_express');
    }
}
