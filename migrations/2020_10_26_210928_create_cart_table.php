<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    protected $table = 'cart';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('product_id', false, true);
            $table->integer('product_sku_id', false, true);
            $table->smallInteger('quantity', false, true)->default(1)->comment('数量');
            $table->tinyInteger('is_check', false, true)->default(1)->comment('是否选中 0:否, 1:是');
            $table->timestamps();

            $table->index(['user_id', 'product_sku_id'], 'user_product_sku_id');
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
