<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    protected $table = 'message';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('sender_id', false, true)->comment('发送消息用户');
            $table->integer('receiver_id', false, true)->default(0)->comment('接收消息用户 0:用户都能接收');
            $table->string('type', 30)->comment('类型 announce:系统公告 remind:系统通知');
            $table->string('module', 30)->default('')->comment('模块');
            $table->integer('module_id', false, true)->default(0);
            $table->string('module_url', 255)->default('');
            $table->tinyInteger('status', false, true)->default(2)->comment("状态 0:删除, 1:已读, 2:未读");
            $table->timestamps();

            $table->index(['sender_id'], 'sender_id');
            $table->index(['receiver_id'], 'receiver_id');
            $table->index(['type', 'status', 'receiver_id'], 'type_status_receiver_id');
            $table->index(['created_at'], 'created_at');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '消息'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
