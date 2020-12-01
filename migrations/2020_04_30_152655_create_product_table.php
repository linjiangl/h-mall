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
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->integer('category_id', false, true);
            $table->integer('brand_id', false, true)->default(0)->comment('品牌');
            $table->integer('text_id', false, true)->comment('商品详情ID');
            $table->string('type', 30)->default('general')->comment('商品类型');
            $table->string('title', 100)->comment('标题');
            $table->string('sub_title', 255)->default('')->comment('副标题');
            $table->integer('sales', false, true)->default(0)->comment('销量');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->decimal('min_price', 10, 2)->unsigned()->default(0)->comment('最小金额');
            $table->decimal('max_price', 10, 2)->unsigned()->default(0)->comment('最大金额');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已下架, 1:已上架');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示 0:不显示, 1:显示');
            $table->string('refund_type', 30)->default('')->comment('退款类型 空:无操作,all:退货退款,money:仅退款,refuse:拒绝退款');
            $table->smallInteger('buy_limit', false, true)->default(0)->comment('单次购买上限 0:不限制');
            $table->smallInteger('buy_limit_total', false, true)->default(0)->comment('购买上限 0:不限制');
            $table->string('images', 1000)->comment('商品图片');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['user_id'], 'user_id');
            $table->index(['category_id', 'status'], 'category_id');
            $table->index(['brand_id', 'status'], 'brand_id');
            $table->index(['title', 'status'], 'title');
            $table->index(['sales', 'status'], 'sales');
            $table->index(['clicks', 'status'], 'clicks');
            $table->index(['min_price', 'status'], 'min_price');
            $table->index(['max_price', 'status'], 'max_price');
            $table->index(['created_at', 'status'], 'created_at');
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
