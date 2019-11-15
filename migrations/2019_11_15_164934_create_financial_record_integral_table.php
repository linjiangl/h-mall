<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateFinancialRecordIntegralTable extends Migration
{
    protected $table = 'financial_record_integral';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('type', 30)->comment('类型 consumed:购买商品 exchange:兑换优惠券 lottery:抽奖');
            $table->integer('integral');
            $table->string('remark', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id']);
            $table->index(['integral']);
            $table->index(['user_id', 'integral']);
            $table->index(['created_at']);
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '财务流水记录-积分'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
