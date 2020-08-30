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

class CreateUserFavoriteTable extends Migration
{
    protected $table = 'user_favorite';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('module', 30)->comment('模块 product:商品, shop:店铺');
            $table->integer('module_id', false, true);
            $table->timestamps();

            $table->unique(['user_id', 'module', 'module_id'], 'user_id_module_id');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户-收藏'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
