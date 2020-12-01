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

class CreateSpecValueTable extends Migration
{
    protected $table = 'spec_value';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('spec_id', false, true);
            $table->string('value', 100);
            $table->tinyInteger('sorting', false, true)->default(0);
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->index(['spec_id', 'status'], 'spec_id');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '商品规格值'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
