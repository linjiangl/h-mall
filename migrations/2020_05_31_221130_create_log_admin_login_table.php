<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateLogAdminLoginTable extends Migration
{
    protected $table = 'log_admin_login';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_admin_login', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('admin_id', false, true);
            $table->string('client_ip', 30);
            $table->string('user_agent', 255);
            $table->timestamps();

            $table->index(['admin_id'], 'admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_admin_login');
    }
}
