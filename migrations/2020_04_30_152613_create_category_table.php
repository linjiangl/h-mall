<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('parent_id', false, true)->default(0);
			$table->string('name', 100)->comment('名称');
			$table->string('icon', 255)->default('')->comment('图标');
			$table->string('cover', 255)->default('')->comment('封面图');
			$table->tinyInteger('position', false, true)->default(0);
			$table->tinyInteger('status')->default(0)->comment('是否显示 0:删除 0:显示, 1:隐藏');
			$table->timestamps();

			$table->index(['parent_id'], 'parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
}
