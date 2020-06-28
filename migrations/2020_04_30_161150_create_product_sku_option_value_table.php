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

class CreateProductSkuOptionValueTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_sku_option_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('product_sku_id', false, true);
            $table->integer('option_value_id', false, true);

            $table->unique(['product_sku_id', 'option_value_id'], 'sku_id_option_value_id');
            $table->index(['option_value_id'], 'option_value_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sku_option_value');
    }
}
