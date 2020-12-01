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
            $table->integer('intro_text_id', false, true)->default(0)->comment('店铺简介');
            $table->string('name', 50)->comment('店铺名称');
            $table->string('logo', 255)->comment('店铺名称');
            $table->decimal('comment_score', 4, 2)->default(5)->comment('评分');
            $table->tinyInteger('status')->default(0)->comment('状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过, 3:已关闭');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['user_id'], 'user_id');
            $table->index(['comment_score', 'status'], 'comment_score');
            $table->index(['created_time', 'status'], 'created_time');
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
