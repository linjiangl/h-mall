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

class CreateCategoryOptionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_option', function (Blueprint $table) {
            $table->integer('category_id', false, true);
            $table->integer('option_id', false, true);

            $table->unique(['category_id', 'option_id'], 'category_id_option_id');

            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('option_id')->references('id')->on('option');
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
