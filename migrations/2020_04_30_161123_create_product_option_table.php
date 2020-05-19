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

class CreateProductOptionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_option', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('product_id', false, true);
            $table->integer('option_id', false, true);

            $table->unique(['product_id', 'option_id'], 'product_id_option_id');

            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('option_id')->references('id')->on('option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option');
    }
}
