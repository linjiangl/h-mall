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
use Hyperf\DbConnection\Db;

class CreateNavigationTable extends Migration
{
    protected $table = 'navigation';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('title', 50);
            $table->string('url', 255)->default('');
            $table->smallInteger('sorting')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '导航'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
