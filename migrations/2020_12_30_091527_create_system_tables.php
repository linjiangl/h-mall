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
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['key'], 'key');

            $table->comment('系统设置');
        });

        Schema::create('text', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('module', 50)->default('product')->comment('模块 product:商品, shop:店铺');
            $table->mediumText('content');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->comment('系统文本');
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('title', 50)->comment('菜单标题');
            $table->string('name', 100)->comment('菜单名称');
            $table->string('icon', 50)->default('');
            $table->string('path', 255)->default('');
            $table->unsignedSmallInteger('sorting')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['parent_id'], 'parent_id');

            $table->comment('系统菜单');
        });

        Schema::create('attachment', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('system', 50)->comment('云存储系统');
            $table->string('type', 50)->comment('文件类型');
            $table->unsignedBigInteger('size')->default(0)->comment('文件大小(字节)');
            $table->string('hash', 128)->default('');
            $table->string('key', 255)->default('');
            $table->string('index', 64)->comment('索引');
            $table->string('encrypt', 64)->default('')->comment('文件的 MD5 散列值');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已失效, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['index'], 'index');
            $table->index(['encrypt'], 'encrypt');
            $table->index(['created_time', 'status'], 'created_time');

            $table->comment('系统附件');
        });

        Schema::create('district', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('name', 50);
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['parent_id'], 'parent_id');
            $table->index(['name'], 'name');

            $table->comment('地区');
        });

        Schema::create('express', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name', 50)->comment('公司名称');
            $table->string('code', 50)->comment('公司编码');
            $table->unsignedSmallInteger('sorting')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['code'], 'code');
            $table->index(['name'], 'name');
            $table->index(['sorting'], 'sorting');

            $table->comment('物流');
        });

        Schema::create('slide', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺 0:系统');
            $table->string('title', 50);
            $table->string('image', 255)->default('')->comment('背景图');
            $table->string('url', 255)->default('');
            $table->unsignedInteger('clicks')->default(0)->comment('点击量');
            $table->unsignedSmallInteger('sorting')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['clicks'], 'clicks');

            $table->comment('幻灯片');
        });

        Schema::create('navigation', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('title', 50);
            $table->string('url', 255)->default('');
            $table->unsignedSmallInteger('sorting')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->comment('导航');
        });

        Schema::create('advertisement', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 30)->comment('广告语');
            $table->string('image', 255)->comment('广告图');
            $table->string('url', 255)->comment('广告链接');
            $table->string('position', 30)->comment('广告位置');
            $table->unsignedInteger('clicks')->default(0)->comment('点击量');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['title'], 'title');
            $table->index(['clicks'], 'clicks');

            $table->comment('广告');
        });

        Schema::create('customer_service', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺 0:系统');
            $table->unsignedTinyInteger('type');
            $table->string('qq', 20)->default('');
            $table->string('wechat', 255)->default('');
            $table->string('name', 20);
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->string('remark', 255)->default('')->comment('备注');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['shop_id'], 'shop_id');

            $table->comment('客服');
        });
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
