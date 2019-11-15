<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateFinancialRecordRedPacketTable extends Migration
{
    protected $table = 'financial_record_red_packet';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('type', 30)->comment('类型 system_presented:系统赠送 consumed:消费');
            $table->decimal('fee', 6, 2)->default(0);
            $table->string('remark', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id']);
            $table->index(['fee']);
            $table->index(['user_id', 'fee']);
            $table->index(['created_at']);
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '财务流水记录-红包'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
