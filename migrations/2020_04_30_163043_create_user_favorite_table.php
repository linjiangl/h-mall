<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_favorite', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('user_id', false, true);
			$table->string('module', 30)->comment('模块 product:商品, shop:店铺');
			$table->integer('module_id', false, true);
			$table->timestamp('created_at')->nullable();

			$table->index(['user_id', 'module'], 'user_id_module');
        });

		\Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户-收藏'");

	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_favorite');
    }
}
