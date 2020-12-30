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

class CreateShopTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('intro_text_id', false, true)->default(0)->comment('店铺简介');
            $table->string('name', 50)->comment('店铺名称');
            $table->string('logo', 255)->comment('店铺名称');
            $table->decimal('comment_score', 4, 2)->default(5)->comment('评分');
            $table->tinyInteger('status')->default(0)->comment('状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过, 3:已关闭');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['user_id'], 'user_id');
            $table->index(['comment_score', 'status'], 'comment_score');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('shop_finance', function (Blueprint $table) {
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('balance', 11, 2)->default(0)->comment('余额');
            $table->decimal('freeze_balance', 10, 2)->default(0)->comment('冻结余额');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['shop_id'], 'shop_id');
            $table->index(['balance'], 'balance');
            $table->index(['freeze_balance'], 'freeze_balance');
        });

        Schema::create('shop_withdraw', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('amount', 10, 2)->unsigned();
            $table->integer('refused_time', false, true)->default(0)->comment('拒绝时间');
            $table->integer('finished_time', false, true)->default(0)->comment('完成时间');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除');
            $table->string('remark', 255)->default('备注');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id', 'status'], 'shop_id');
            $table->index(['amount', 'status'], 'amount');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('shop_statement', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->decimal('amount', 10, 2);
            $table->string('type', 20)->comment('类别 order:订单, withdraw:提现, refund:退款');
            $table->string('module', 20)->default('')->comment('关联模型');
            $table->integer('module_id', false, true)->default(0);
            $table->string('order_sn', 64)->default('');
            $table->string('remark', 255)->default('');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id', 'amount'], 'shop_id_amount');
            $table->index(['amount'], 'amount');
        });

        Db::statement("ALTER TABLE `shop` COMMENT '店铺'");
        Db::statement("ALTER TABLE `shop_finance` COMMENT '店铺资金'");
        Db::statement("ALTER TABLE `shop_withdraw` COMMENT '店铺提现'");
        Db::statement("ALTER TABLE `shop_statement` COMMENT '店铺流水'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
        Schema::dropIfExists('shop_finance');
        Schema::dropIfExists('shop_withdraw');
        Schema::dropIfExists('shop_statement');
    }
}
