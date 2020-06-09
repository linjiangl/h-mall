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
            $table->string('action', 255);
            $table->string('method', 10);
            $table->string('url', 120);
            $table->string('header', 255);
            $table->string('query', 1000);
            $table->text('request');
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
