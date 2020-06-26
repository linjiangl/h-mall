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

class CreateShopFinanceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_finance', function (Blueprint $table) {
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('balance', 11, 2)->default(0)->comment('余额');
            $table->decimal('freeze_balance', 10, 2)->default(0)->comment('冻结余额');

            $table->unique(['shop_id'], 'shop_id');
            $table->index(['balance'], 'balance');
            $table->index(['freeze_balance'], 'freeze_balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_finance');
    }
}
