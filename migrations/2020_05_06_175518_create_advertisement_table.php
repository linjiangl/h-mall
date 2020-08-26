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

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisement', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 30)->comment('标题');
            $table->string('image', 255)->comment('图片');
            $table->string('url', 255)->comment('链接');
            $table->string('position', 30)->comment('位置');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->tinyInteger('status', false, true)->default(0)->comment('状态 0:不可用, 1:可用');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status'], 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement');
    }
}
