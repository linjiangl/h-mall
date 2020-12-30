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

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('username', 30)->comment('用户名');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->string('real_name', 20)->default('')->comment('姓名');
            $table->string('mobile', 20)->default('')->comment('手机号');
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->string('password', 64);
            $table->string('salt', 24);
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->integer('lasted_login_time', false, true)->default(0)->comment('最后登录时间');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['username', 'status'], 'username');
            $table->unique(['created_time', 'status'], 'created_time');
        });

        Schema::create('admin_login', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('admin_id', false, true);
            $table->string('username', 30)->comment('管理员用户名');
            $table->string('client_ip', 30);
            $table->string('user_agent', 255);
            $table->tinyInteger('status')->default(0)->comment('状态 -1:已删除');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['admin_id', 'status'], 'admin_id');
        });

        Schema::create('admin_action', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('admin_id', false, true);
            $table->string('username', 30)->comment('管理员用户名');
            $table->string('client_ip', 30);
            $table->string('module', 50);
            $table->string('action', 255);
            $table->tinyInteger('status')->default(0)->comment('状态 -1:已删除');
            $table->text('remark');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['admin_id', 'status'], 'admin_id');
        });

        Db::statement("ALTER TABLE `admin` COMMENT '管理员'");
        Db::statement("ALTER TABLE `admin_login` COMMENT '管理员登录日志'");
        Db::statement("ALTER TABLE `admin_action` COMMENT '管理员操作日志'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('admin_login');
        Schema::dropIfExists('admin_action');
    }
}
