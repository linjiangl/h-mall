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

class CreateBrandTable extends Migration
{
    protected $table = 'brand';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50);
            $table->string('logo', 255);
            $table->tinyInteger('status', false, true)->default(1)->comment('状态 -1:已删除, 0:已失效, 1:已启用');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '品牌'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
