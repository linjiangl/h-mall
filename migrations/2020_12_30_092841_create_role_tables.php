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

class CreateRoleTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('name', 50);
            $table->string('identifier', 50)->comment('标识');
            $table->tinyInteger('is_super', false, true)->default(0)->comment('是否超管');
            $table->tinyInteger('is_system', false, true)->default(0)->comment('是否系统权限');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['identifier'], 'identifier');
        });

        Schema::create('role_admin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('role_id', false, true);
            $table->integer('admin_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['role_id', 'admin_id'], 'role_admin_id');
            $table->index(['admin_id'], 'admin_id');
        });

        Schema::create('role_menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('role_id', false, true);
            $table->integer('menu_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['role_id', 'menu_id'], 'role_menu_id');
            $table->index(['menu_id'], 'menu_id');
        });

        Db::statement("ALTER TABLE `role` COMMENT '权限'");
        Db::statement("ALTER TABLE `role_admin` COMMENT '管理员权限'");
        Db::statement("ALTER TABLE `role_menu` COMMENT '权限菜单'");
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
