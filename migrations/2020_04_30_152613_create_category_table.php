<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

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
            $table->tinyInteger('sorting', false, true)->default(0);
            $table->tinyInteger('status')->default(0)->comment('是否显示 -1:已删除 0:已禁用, 1:已启用');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->index(['parent_id', 'status'], 'parent_id');
            $table->index(['name', 'status'], 'name');
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
