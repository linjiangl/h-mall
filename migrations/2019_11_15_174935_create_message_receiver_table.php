<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

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
            $table->integer('message_id', false, true);
            $table->integer('user_id', false, true);
            $table->tinyInteger('status', false, true)->default(2)->comment("状态 1:已读, 2:未读");
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['message_id', 'user_id']);
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
