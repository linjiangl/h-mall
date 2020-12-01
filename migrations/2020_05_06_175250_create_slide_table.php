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

class CreateSlideTable extends Migration
{
    protected $table = 'slide';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true)->default(0)->comment('店铺 0:系统');
            $table->string('title', 50);
            $table->string('image', 255)->default('')->comment('背景图');
            $table->string('url', 255)->default('');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->smallInteger('sorting', false, true)->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id', 'status'], 'shop_id');
            $table->index(['clicks', 'status'], 'clicks');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '幻灯片'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
