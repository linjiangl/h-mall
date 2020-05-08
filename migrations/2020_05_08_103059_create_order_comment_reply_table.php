<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateOrderCommentReplyTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_comment_reply', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('comment_id', false, true)->comment('评论ID');
			$table->integer('product_id', false, true);
			$table->integer('product_sku_id', false, true);
			$table->integer('user_id', false, true)->comment('回复评论的用户ID');
			$table->integer('reply_user_id', false, true)->default(0)->comment('被回复评论的用户ID');
			$table->integer('top', false, true)->default(0)->comment('点赞');
			$table->string('content', 255)->comment('评论内容');
			$table->tinyInteger('status', false, true)->default(1)->comment('状态 0:待审核, 1:已通过, 2:未通过');
			$table->timestamps();

			$table->index(['comment_id'], 'comment_id');
			$table->index(['product_id', 'top'], 'product_id_top');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_comment_reply');
    }
}
