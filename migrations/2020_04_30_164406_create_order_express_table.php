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

class CreateOrderExpressTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_express', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('order_id', false, true)->default(0);
            $table->integer('refund_id', false, true)->default(0);
            $table->smallInteger('express_id', false, true);
            $table->string('express_name', 20)->comment('快递名称');
            $table->string('express_no', 64)->comment('快递单号');
            $table->decimal('amount', 6, 2)->unsigned()->default(0)->comment('快递费');
            $table->integer('text_id')->default(0);
            $table->string('remark', 255)->default('');
            $table->timestamps();

            $table->index(['order_id'], 'order_id');
            $table->index(['refund_id'], 'refund_id');
            $table->index(['express_id'], 'express_id');
            $table->index(['express_no'], 'express_no');

            $table->foreign('express_id')->references('id')->on('express');
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
