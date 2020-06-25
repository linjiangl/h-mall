<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateRoleAdminTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_admin', function (Blueprint $table) {
            $table->integer('role_id', false, true);
            $table->integer('admin_id', false, true);

            $table->unique(['role_id', 'admin_id'], 'role_admin_id');

            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('admin_id')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_admin');
    }
}
