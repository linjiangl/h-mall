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
            $table->decimal('price', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->decimal('original_price', 10, 2)->unsigned()->default(0)->comment('原价');
            $table->integer('stock', false, true)->default(0)->comment('库存');
            $table->integer('sales', false, true)->default(0)->comment('销量');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->string('image', 255)->default('')->comment('图片');
            $table->timestamps();

            $table->index(['shop_id'], 'shop_id');
            $table->index(['product_id'], 'product_id');

            $table->foreign('product_id')->references('id')->on('product');
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
