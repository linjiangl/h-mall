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

class CreateExpressTable extends Migration
{
    protected $table = 'express';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 50)->comment('公司名称');
            $table->string('code', 50)->comment('公司编码');
            $table->smallInteger('sorting')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['code'], 'code');
            $table->index(['name'], 'name');
            $table->index(['sorting'], 'sorting');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '地区'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
