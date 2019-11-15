<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    protected $table = 'user';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('username', 30)->comment('用户名');
            $table->string('nickname', 50)->comment('昵称');
            $table->string('mobile', 20)->default('')->comment('手机');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->tinyInteger('sex', false, true)->default(0)->comment('性别 1:男, 2:女, 3:保密');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->string('password', 64)->comment('密码');
            $table->string('salt', 24)->default('')->comment('加密盐');
            $table->tinyInteger('status', false, true)->default(1)->comment('状态 1:正常, 2:禁用');
            $table->timestamp('last_login_at')->comment('最后登录时间');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['username']);
            $table->index(['mobile']);
            $table->index(['email']);
            $table->index(['nickname']);
            $table->index(['created_at']);
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
