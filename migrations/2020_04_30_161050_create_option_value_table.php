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

class CreateOptionValueTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('option_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('option_id', false, true);
            $table->string('value', 100);
            $table->tinyInteger('position', false, true)->default(0);
            $table->timestamps();

            $table->index(['option_id'], 'option_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_value');
    }
}
