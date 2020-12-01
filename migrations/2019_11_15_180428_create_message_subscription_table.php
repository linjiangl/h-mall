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

class CreateMessageSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message_subscription', function (Blueprint $table) {
            $table->integerIncrements('user_id');
            $table->text('setting');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->unique(['user_id'], 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_subscription');
    }
}
