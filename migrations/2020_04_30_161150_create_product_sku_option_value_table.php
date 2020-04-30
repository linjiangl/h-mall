<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

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
			$table->timestamps();
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
