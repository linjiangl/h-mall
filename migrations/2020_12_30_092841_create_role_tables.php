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

class CreateRoleTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('name', 50);
            $table->string('identifier', 50)->comment('标识');
            $table->unsignedTinyInteger('is_super')->default(0)->comment('是否超管');
            $table->unsignedTinyInteger('is_system')->default(0)->comment('是否系统权限');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['identifier'], 'identifier');

            $table->comment('客服');
        });

        Schema::create('role_admin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['role_id', 'admin_id'], 'role_admin_id');
            $table->index(['admin_id'], 'admin_id');

            $table->comment('管理员权限');
        });

        Schema::create('role_menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['role_id', 'menu_id'], 'role_menu_id');
            $table->index(['menu_id'], 'menu_id');

            $table->comment('权限菜单');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
        Schema::dropIfExists('role_admin');
        Schema::dropIfExists('role_menu');
    }
}
