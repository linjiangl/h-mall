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

class CreateFinancialRecordTable extends Migration
{
    protected $table = 'financial_record';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('type', 30)->comment('类型 recharged:充值 consumed:消费');
            $table->decimal('amount', 9, 2)->default(0)->comment('金额');
            $table->integer('integral')->default(0)->comment('积分');
            $table->decimal('red_packet', 5, 2)->default(0)->comment('红包');
            $table->string('intro', 100)->comment('');
            $table->string('target', 30)->default('');
            $table->integer('target_id', false, true)->default(0);
            $table->string('remark', 255)->default('');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id'], 'user_id');
            $table->index(['user_id', 'type'], 'user_id_type');
            $table->index(['user_id', 'amount'], 'user_id_amount');
            $table->index(['user_id', 'integral'], 'user_id_integral');
            $table->index(['user_id', 'red_packet'], 'user_id_red_packet');
            $table->index(['user_id', 'created_at'], 'user_id_created_at');
            $table->index(['created_at', 'type'], 'created_at_type');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '财务流水记录-余额'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
