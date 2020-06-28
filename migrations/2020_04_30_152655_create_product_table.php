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

class CreateProductTable extends Migration
{
    protected $table = 'product';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->tinyInteger('type')->default(0)->comment('类别 0:普通,1:虚拟');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->integer('category_id', false, true);
            $table->integer('text_id', false, true);
            $table->string('title', 100)->comment('商品标题');
            $table->string('description', 255)->comment('描述');
            $table->integer('sales', false, true)->default(0)->comment('销量');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->smallInteger('buy_limit', false, true)->default(0)->comment('单次购买上限 0:不限制');
            $table->smallInteger('buy_limit_total', false, true)->default(0)->comment('购买上限 0:不限制');
            $table->decimal('min_price', 10, 2)->unsigned()->default(0)->comment('最小金额');
            $table->decimal('max_price', 10, 2)->unsigned()->default(0)->comment('最大金额');
            $table->string('images', 1000)->comment('商品图片');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示 0:不显示, 1:显示');
            $table->string('refund_type', 30)->default('')->comment('退款类型 空:无操作,all:退货退款,money:仅退款,refuse:拒绝退款');
            $table->tinyInteger('status')->default(1)->comment('状态 0:删除, 1:正常, 2:下架');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['shop_id', 'status'], 'shop_id_status');
            $table->index(['user_id', 'status'], 'user_id_status');
            $table->index(['category_id', 'status'], 'category_id_status');
            $table->index(['created_at', 'status'], 'created_at_status');
            $table->index(['title', 'status'], 'title_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
