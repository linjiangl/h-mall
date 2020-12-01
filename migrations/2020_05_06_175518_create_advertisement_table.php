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

class CreateAdvertisementTable extends Migration
{
    protected $table = 'advertisement';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 30)->comment('标题');
            $table->string('image', 255)->comment('图片');
            $table->string('url', 255)->comment('链接');
            $table->string('position', 30)->comment('位置');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->index(['title', 'status'], 'title');
            $table->index(['clicks', 'status'], 'clicks');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '广告'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
