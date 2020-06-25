<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

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
            $table->string('name', 50)->comment('菜单名称');
            $table->string('icon', 100)->default('');
            $table->string('path', 100)->default('');
            $table->tinyInteger('status', false, true)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name'], 'name');
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
