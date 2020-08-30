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

class CreateSpecTable extends Migration
{
    protected $table = 'spec';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true)->default(0)->comment('店铺id 0:系统');
            $table->string('name', 50)->comment('名称');
            $table->tinyInteger('sorting', false, true)->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['shop_id'], 'shop_id');
            $table->index(['name'], 'name');
            $table->index(['sorting'], 'sorting');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '商品规格'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
