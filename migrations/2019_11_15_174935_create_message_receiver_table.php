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

class CreateMessageReceiverTable extends Migration
{
    protected $table = 'message_receiver';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('message_id', false, true);
            $table->tinyInteger('status', false, true)->default(2)->comment('状态 0:删除, 1:已读, 2:未读');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['message_id'], 'message_id');
            $table->index(['user_id', 'status'], 'user_id_status');
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
