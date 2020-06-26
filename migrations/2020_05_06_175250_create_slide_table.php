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

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slide', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->string('title', 50);
            $table->string('image', 255)->default('')->comment('背景图');
            $table->string('url', 255)->default('');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->smallInteger('position', false, true)->default(0)->comment('排序 倒叙');
            $table->tinyInteger('status', false, true)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['shop_id', 'status'], 'shop_id_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide');
    }
}
