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
            $table->integer('shop_id', false, true);
            $table->tinyInteger('type', false, true);
            $table->string('qq', 20);
            $table->string('name', 20);
            $table->string('remark', 255)->default('')->comment('备注');
            $table->tinyInteger('status')->default(0)->comment('状态 0:关闭, 1:开启');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['shop_id', 'status'], 'shop_id_status');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '客服'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
