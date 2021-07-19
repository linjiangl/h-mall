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

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id')->default(0)->comment('门店 0:管理员账号');
            $table->string('username', 30)->comment('用户名');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->string('real_name', 20)->default('')->comment('姓名');
            $table->string('mobile', 20)->default('')->comment('手机号');
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->string('password', 64);
            $table->string('salt', 24);
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:禁用, 1:启用');
            $table->unsignedInteger('lasted_login_time')->default(0)->comment('最后登录时间');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['username'], 'username');
            $table->index(['mobile'], 'mobile');
            $table->index(['lasted_login_time'], 'lasted_login_time');

            $table->comment('管理员');
        });

        Schema::create('admin_login', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('admin_id');
            $table->string('username', 30)->comment('管理员用户名');
            $table->string('client_ip', 30);
            $table->string('user_agent', 255);
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['admin_id'], 'admin_id');

            $table->comment('管理员登录日志');
        });

        Schema::create('admin_action', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('admin_id');
            $table->string('username', 30)->comment('管理员用户名');
            $table->string('client_ip', 30);
            $table->string('module', 50);
            $table->string('action', 255);
            $table->text('remark');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['admin_id'], 'admin_id');

            $table->comment('管理员操作日志');
        });
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
