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

class CreateShopWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_withdraw', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('amount', 10, 2)->unsigned();
            $table->tinyInteger('status', false, true)->default(0);
            $table->integer('refused_time', false, true)->default(0)->comment('拒绝时间');
            $table->integer('finished_time', false, true)->default(0)->comment('完成时间');
            $table->string('remark', 255)->default('备注');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['shop_id', 'status'], 'shop_id_status');
            $table->index(['amount', 'status'], 'amount_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_withdraw');
    }
}
