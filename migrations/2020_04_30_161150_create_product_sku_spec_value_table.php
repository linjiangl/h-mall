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

class CreateProductSkuSpecValueTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_sku_spec_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('product_sku_id', false, true);
            $table->integer('spec_value_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['product_sku_id', 'spec_value_id'], 'product_sku_spec_value_id');
            $table->index(['spec_value_id'], 'spec_value_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sku_spec_value');
    }
}
