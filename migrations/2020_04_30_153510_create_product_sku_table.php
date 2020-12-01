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

class CreateProductSkuTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_sku', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('product_id', false, true);
            $table->integer('coupon_id', false, true)->default(0)->comment('优惠券ID');
            $table->decimal('price', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->decimal('original_price', 10, 2)->unsigned()->default(0)->comment('原价');
            $table->integer('stock', false, true)->default(0)->comment('库存');
            $table->integer('sales', false, true)->default(0)->comment('销量');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->string('image', 255)->default('')->comment('图片');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['product_id'], 'product_id');
            $table->index(['coupon_id'], 'coupon_id');
            $table->index(['price'], 'price');
            $table->index(['stock'], 'stock');
            $table->index(['sales'], 'sales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sku');
    }
}
