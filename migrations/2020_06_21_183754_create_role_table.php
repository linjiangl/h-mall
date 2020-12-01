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

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('name', 50);
            $table->string('identifier', 50)->comment('标识');
            $table->tinyInteger('is_super', false, true)->default(0)->comment('是否超管');
            $table->tinyInteger('is_system', false, true)->default(0)->comment('是否系统权限');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->unique(['identifier'], 'identifier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
}
