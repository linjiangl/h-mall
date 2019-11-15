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

class CreateMembershipCardTable extends Migration
{
    protected $table = 'membership_card';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integer('user_id', false, true)->unique();
            $table->string('serial_no', 20)->comment('会员卡号')->unique();
            $table->tinyInteger('grade', false, true)->default(1)->comment('会员等级');
            $table->integer('total_exp', false, true)->default(0)->comment('总经验');
            $table->integer('current_exp', false, true)->default(0)->comment('当前经验');
            $table->string('real_name', 20)->comment('真实姓名');
            $table->string('mobile', 20)->comment('手机号码');
            $table->string('id_card', 20)->comment('身份证号码');
            $table->string('password', 32)->comment('会员卡密码');
            $table->timestamps();

            $table->index(['grade']);
            $table->index(['total_exp']);
            $table->index(['real_name']);
            $table->index(['mobile']);
            $table->index(['id_card']);
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户会员卡'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
