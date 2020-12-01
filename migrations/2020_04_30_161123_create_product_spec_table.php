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

class CreateProductSpecTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('product_id', false, true);
            $table->integer('spec_id', false, true);
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->unique(['product_id', 'spec_id'], 'product_spec_id');
            $table->index(['spec_id'], 'spec_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_spec');
    }
}
