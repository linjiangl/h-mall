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

class CreateUserInvoiceTable extends Migration
{
    protected $table = 'user_invoice';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->tinyInteger('open_type', false, true)->default(1)->comment('开具类型 0:个人 1:企业');
            $table->tinyInteger('type', false, true)->default(0)->comment('发票类型 0:增值税普通发票 1:增值税专用发票 2:组织(非企业)增值税普通发票');
            $table->string('title', 150)->comment('发票抬头');
            $table->string('taxpayer_id', 30)->comment('纳税人识别号');
            $table->string('register_address', 100)->comment('注册地址');
            $table->string('register_phone', 30)->comment('注册电话');
            $table->string('bank_name', 100)->comment('开户银行');
            $table->string('bank_account', 100)->comment('银行账号');
            $table->tinyInteger('content_type', false, true)->default(0)->comment('发票内容 0:商品明细');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->string('address', 1500)->default('')->comment('收票人地址');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id'], 'user_id');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户-发票'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
