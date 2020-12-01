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

class CreateEvaluationReplyTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluation_reply', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('evaluation_id', false, true)->comment('评价ID');
            $table->integer('product_id', false, true);
            $table->integer('product_sku_id', false, true);
            $table->integer('user_id', false, true)->comment('回复评价的用户ID');
            $table->integer('reply_user_id', false, true)->default(0)->comment('被回复评价的用户ID');
            $table->integer('top', false, true)->default(0)->comment('点赞');
            $table->string('content', 255)->comment('评论内容');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['evaluation_id'], 'evaluation_id');
            $table->index(['product_id', 'top'], 'product_id_top');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_reply');
    }
}
