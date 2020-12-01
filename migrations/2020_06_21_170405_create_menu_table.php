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
            $table->smallInteger('sorting', false, true)->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

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
