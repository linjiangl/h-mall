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

class CreateTextTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('text', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 50)->default('product')->comment('模块 product:商品, shop:店铺');
            $table->mediumText('content');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text');
    }
}
