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

class CreateUserWalletTable extends Migration
{
    protected $table = 'user_wallet';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integer('user_id', false, true);
            $table->integer('integral', false, true)->default(0)->comment('积分');
            $table->decimal('balance', 10, 2)->default(0)->comment('余额');
            $table->integer('freeze_integral', false, true)->default(0)->comment('冻结的积分');
            $table->decimal('freeze_balance', 10, 2)->default(0)->comment('冻结的余额');

            $table->unique(['user_id'], 'user_id');
            $table->index(['integral'], 'integral');
            $table->index(['balance'], 'balance');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户钱包'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
