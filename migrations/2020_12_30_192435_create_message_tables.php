<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://mall.xcmei.com
 * @document https://mall.xcmei.com
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Db;

class CreateMessageTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('sender_id', false, true)->comment('发送消息用户');
            $table->integer('receiver_id', false, true)->default(0)->comment('接收消息用户 0:用户都能接收');
            $table->integer('text_id', false, true);
            $table->string('type', 30)->comment('类型 announce:系统公告 remind:系统通知');
            $table->string('module', 30)->default('')->comment('模块');
            $table->integer('module_id', false, true)->default(0);
            $table->string('module_url', 255)->default('');
            $table->tinyInteger('status')->default(0)->comment('状态 -1:删除, 0:未读, 1:已读');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['sender_id', 'status', 'type'], 'sender_id');
            $table->index(['receiver_id', 'status', 'type'], 'receiver_id_type');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('message_text', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('title', 100)->default('')->comment('标题');
            $table->text('content')->comment('消息内容');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);
        });

        Schema::create('message_receiver', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('message_id', false, true);
            $table->tinyInteger('status')->default(0)->comment('状态 -1:删除, 0:未读, 1:已读');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['message_id'], 'message_id');
            $table->index(['user_id', 'status'], 'user_id');
        });

        Schema::create('message_subscription', function (Blueprint $table) {
            $table->integerIncrements('user_id');
            $table->text('setting');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['user_id'], 'user_id');
        });

        Db::statement("ALTER TABLE `message` COMMENT '消息'");
        Db::statement("ALTER TABLE `message_text` COMMENT '消息文本'");
        Db::statement("ALTER TABLE `message_receiver` COMMENT '消息接收者'");
        Db::statement("ALTER TABLE `message_subscription` COMMENT '消息订阅'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
        Schema::dropIfExists('message_text');
        Schema::dropIfExists('message_receiver');
        Schema::dropIfExists('message_subscription');
    }
}
