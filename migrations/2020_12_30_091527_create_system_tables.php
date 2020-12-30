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

class CreateSystemTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('key', 50);
            $table->mediumText('value');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['key'], 'key');
        });

        Schema::create('text', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 50)->default('goods')->comment('模块 goods:商品, shop:店铺');
            $table->mediumText('content');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('title', 50)->comment('菜单标题');
            $table->string('name', 100)->comment('菜单名称');
            $table->string('icon', 50)->default('');
            $table->string('path', 255)->default('');
            $table->smallInteger('sorting', false, true)->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['parent_id'], 'parent_id');
        });

        Schema::create('attachment', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('system', 50)->comment('云存储系统');
            $table->string('type', 50)->comment('文件类型');
            $table->bigInteger('size', false, true)->default(0)->comment('文件大小(字节)');
            $table->string('hash', 128)->default('');
            $table->string('key', 255)->default('');
            $table->string('index', 64)->comment('索引');
            $table->string('encrypt', 64)->default('')->comment('文件的 MD5 散列值');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已失效, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['index'], 'index');
            $table->index(['encrypt'], 'encrypt');
            $table->index(['created_time', 'status'], 'md5');
        });

        Schema::create('district', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id', false, true)->default(0);
            $table->string('name', 50);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['parent_id'], 'parent_id');
            $table->index(['name'], 'name');
        });

        Schema::create('express', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 50)->comment('公司名称');
            $table->string('code', 50)->comment('公司编码');
            $table->smallInteger('sorting')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['code'], 'code');
            $table->index(['name'], 'name');
            $table->index(['sorting'], 'sorting');
        });

        Schema::create('slide', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true)->default(0)->comment('店铺 0:系统');
            $table->string('title', 50);
            $table->string('image', 255)->default('')->comment('背景图');
            $table->string('url', 255)->default('');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->smallInteger('sorting', false, true)->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id', 'status'], 'shop_id');
            $table->index(['clicks', 'status'], 'clicks');
        });

        Schema::create('navigation', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('title', 50);
            $table->string('url', 255)->default('');
            $table->smallInteger('sorting')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);
        });

        Schema::create('advertisement', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 30)->comment('标题');
            $table->string('image', 255)->comment('图片');
            $table->string('url', 255)->comment('链接');
            $table->string('position', 30)->comment('位置');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['title', 'status'], 'title');
            $table->index(['clicks', 'status'], 'clicks');
        });

        Schema::create('customer_service', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true)->default(0)->comment('店铺 0:系统');
            $table->tinyInteger('type', false, true);
            $table->string('qq', 20)->default('');
            $table->string('wechat', 255)->default('');
            $table->string('name', 20);
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->string('remark', 255)->default('')->comment('备注');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id', 'status'], 'shop_id');
        });

        Db::statement("ALTER TABLE `setting` COMMENT '系统设置'");
        Db::statement("ALTER TABLE `text` COMMENT '系统文本'");
        Db::statement("ALTER TABLE `menu` COMMENT '系统菜单'");
        Db::statement("ALTER TABLE `attachment` COMMENT '系统附件'");
        Db::statement("ALTER TABLE `district` COMMENT '地区'");
        Db::statement("ALTER TABLE `express` COMMENT '物流'");
        Db::statement("ALTER TABLE `slide` COMMENT '幻灯片'");
        Db::statement("ALTER TABLE `navigation` COMMENT '导航'");
        Db::statement("ALTER TABLE `advertisement` COMMENT '广告'");
        Db::statement("ALTER TABLE `customer_service` COMMENT '客服'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
        Schema::dropIfExists('text');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('attachment');
        Schema::dropIfExists('district');
        Schema::dropIfExists('express');
        Schema::dropIfExists('slide');
        Schema::dropIfExists('navigation');
        Schema::dropIfExists('advertisement');
        Schema::dropIfExists('customer_service');
    }
}
