<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateLogAdminActionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_admin_action', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('username', 30)->comment('管理员用户名');
            $table->string('client_ip', 30);
            $table->string('module', 50);
            $table->string('action', 255);
            $table->text('remark');
            $table->timestamps();

            $table->index(['username'], 'username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_admin_action');
    }
}
