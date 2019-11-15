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
            $table->integer('send_id', false, true)->comment('发送者');
            $table->integer('to_id', false, true)->default(0)->comment('接受者 0:用户都能接收');
            $table->string('type', 30)->comment('类型 announce:系统公告 remind:系统通知');
            $table->string('target', 30)->default('');
            $table->integer('target_id', false, true)->default(0);
            $table->string('target_url', 255)->default('');
            $table->tinyInteger('status', false, true)->default(2)->comment("状态 1:已读, 2:未读");
            $table->timestamps();
            $table->softDeletes();

            $table->index(['to_id', 'status']);
            $table->index(['to_id', 'type']);
            $table->index(['to_id', 'created_at']);
            $table->index(['created_at']);
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
