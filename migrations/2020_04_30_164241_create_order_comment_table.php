<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateOrderCommentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_comment', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('order_id', false, true);
            $table->integer('order_item_id', false, true);
            $table->integer('product_id', false, true);
            $table->integer('product_sku_id', false, true);
            $table->tinyInteger('score', false, true)->default(0)->comment('评分');
            $table->integer('top', false, true)->default(0)->comment('点赞');
            $table->integer('reply_num', false, true)->default(0)->comment('回复数量');
            $table->integer('additional_num', false, true)->default(0)->comment('追评数量');
            $table->integer('additional_comment_id', false, true)->default(0)->comment('追评ID');
            $table->tinyInteger('is_additional', false, true)->default(0)->comment('是否追加评论 0:否,1:是');
            $table->tinyInteger('is_image', false, true)->default(0)->comment('是否带图 0:否,1:是');
            $table->tinyInteger('is_anonymous', false, true)->default(0)->comment('是否匿名 0:否,1:是');
            $table->string('content', 255)->comment('评论内容');
            $table->string('images', 1000)->default('')->comment('评论图片');
            $table->tinyInteger('status', false, true)->default(1)->comment('状态 0:待审核, 1:已通过, 2:未通过');
            $table->timestamps();

            $table->unique(['order_item_id'], 'order_item_id');
            $table->index(['order_id'], 'order_id');
            $table->index(['user_id', 'status'], 'user_id_status');
            $table->index(['product_id', 'top'], 'product_id_top');

            $table->foreign('order_id')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_comment');
    }
}
