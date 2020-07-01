<?php

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('title', 50)->comment('菜单标题');
            $table->string('name', 100)->comment('菜单名称');
            $table->string('icon', 50)->default('');
            $table->string('path', 255)->default('');
            $table->smallInteger('order', false, true)->default(0);
            $table->tinyInteger('status', false, true)->default(0);
            $table->timestamps();

            $table->index(['parent_id'], 'parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
}
