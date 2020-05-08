<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateRefundActionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refund_action', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('refund_id', false, true);
			$table->integer('order_id', false, true);
			$table->integer('user_id', false, true);
			$table->integer('action_user_id', false, true)->default(0)->comment('操作用户 0:系统');
			$table->tinyInteger('refund_status', false, true)->comment('退款状态');
			$table->string('remark', 255)->default('');
			$table->timestamps();

			$table->index(['refund_id'], 'refund_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_action');
    }
}