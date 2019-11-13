<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserWalletTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_wallet', function (Blueprint $table) {
            $table->integer('user_id', false, true)->unique();
            $table->integer('integral', false, true)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->decimal('red_packet', 7, 2)->default(0);
            $table->integer('freeze_integral', false, true)->default(0);
            $table->decimal('freeze_balance', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallet');
    }
}
