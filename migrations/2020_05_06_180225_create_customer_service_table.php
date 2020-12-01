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

class CreateCustomerServiceTable extends Migration
{
    protected $table = 'customer_service';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true)->default(0)->comment('店铺 0:系统');
            $table->tinyInteger('type', false, true);
            $table->string('qq', 20)->default('');
            $table->string('wechat', 255)->default('');
            $table->string('name', 20);
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->string('remark', 255)->default('')->comment('备注');
            $table->integer('created_at', false, true)->default(0);
            $table->integer('updated_at', false, true)->default(0);

            $table->index(['shop_id', 'status'], 'shop_id');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '客服'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
