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

class CreateShopWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_withdraw', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->mediumInteger('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('amount', 10, 2)->unsigned();
            $table->tinyInteger('status', false, true)->default(0);
            $table->timestamp('finished_at')->nullable();
            $table->string('remark', 255)->default('备注');
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
        Schema::dropIfExists('shop_withdraw');
    }
}
