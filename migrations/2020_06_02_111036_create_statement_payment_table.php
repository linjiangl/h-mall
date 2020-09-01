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
use Hyperf\DbConnection\Db;

class CreateStatementPaymentTable extends Migration
{
    protected $table = 'statement_payment';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('order_ids', 255);
            $table->string('business_no', 64)->comment('支付业务号');
            $table->string('payment_method', 20)->comment('支付方式');
            $table->string('trade_no', 64)->default('')->comment('第三方支付流水号');
            $table->decimal('amount', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->tinyInteger('status')->default(0)->comment('支付状态 0:待支付, 1:支付成功, 2:重复支付退款');
            $table->string('remark', 3000)->default('');
            $table->integer('finished_time', false, true)->default(0)->comment('支付完成的时间');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['business_no'], 'business_no');
            $table->index(['trade_no'], 'trade_no');
            $table->index(['order_ids'], 'order_ids');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '账单-支付记录'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
