<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('role_id', false, true);
            $table->integer('menu_id', false, true);

            $table->unique(['role_id', 'menu_id'], 'role_menu_id');
            $table->index(['menu_id'], 'menu_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_menu');
    }
}
