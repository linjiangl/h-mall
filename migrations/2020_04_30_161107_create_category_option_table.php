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

class CreateCategoryOptionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_option', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('category_id', false, true);
            $table->integer('option_id', false, true);

            $table->unique(['category_id', 'option_id'], 'category_id_option_id');
            $table->index(['option_id'], 'option_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_option');
    }
}
