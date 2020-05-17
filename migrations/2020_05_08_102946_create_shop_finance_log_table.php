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

class CreateShopFinanceLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_finance_log', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('amount', 10, 2);
            $table->string('type', 20)->comment('类别 order:订单, withdraw:提现, refund:退款');
            $table->string('module', 20)->default('')->comment('关联模型');
            $table->integer('module_id', false, true)->default(0);
            $table->string('order_sn', 64)->default('');
            $table->string('remark', 255)->default('');
            $table->timestamps();

            $table->index(['shop_id', 'amount'], 'shop_id_amount');
            $table->index(['amount'], 'amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_finance_log');
    }
}
