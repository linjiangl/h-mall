<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('user_id', false, true);
			$table->integer('text_id', false, true);
			$table->string('name', 50)->comment('店铺名称');
			$table->string('logo', 255)->comment('店铺名称');
			$table->decimal('comment_score', 4, 2)->default(5)->comment('评分');
			$table->tinyInteger('status', false, true)->default(0)->comment('状态 0:待审核, 1:已通过, 2:未通过, 3:已关闭');
			$table->timestamps();

			$table->index(['user_id'], 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
    }
}
