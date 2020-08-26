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

class CreateUserVipCardTable extends Migration
{
    protected $table = 'user_vip_card';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('serial_no', 20)->comment('会员卡号');
            $table->tinyInteger('grade', false, true)->default(1)->comment('会员等级');
            $table->integer('total_exp', false, true)->default(0)->comment('总经验');
            $table->integer('current_exp', false, true)->default(0)->comment('当前经验');
            $table->string('real_name', 20)->default('')->comment('真实姓名');
            $table->string('mobile', 20)->comment('手机号码');
            $table->string('id_card', 20)->default('')->comment('身份证号码');
            $table->string('password', 32)->default('')->comment('会员卡密码');
            $table->tinyInteger('status', false, true)->default(2)->comment('状态 1:已激活 2:未激活');
            $table->timestamps();

            $table->index(['user_id'], 'user_id');
            $table->unique(['serial_no'], 'serial_no');
            $table->index(['mobile'], 'mobile');
            $table->index(['grade'], 'grade');
            $table->index(['total_exp'], 'total_exp');
            $table->index(['id_card'], 'id_card');
            $table->index(['created_at'], 'created_at');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户-会员卡'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
