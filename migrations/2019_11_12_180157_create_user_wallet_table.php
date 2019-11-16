<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

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
            $table->integer('integral', false, true)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->decimal('red_packet', 7, 2)->default(0);
            $table->integer('freeze_integral', false, true)->default(0);
            $table->decimal('freeze_balance', 10, 2)->default(0);
            $table->decimal('freeze_red_packet', 10, 2)->default(0);

            $table->unique(['user_id'], 'user_id');
            $table->index(['integral'], 'integral');
            $table->index(['balance'], 'balance');
            $table->index(['red_packet'], 'red_packet');
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
