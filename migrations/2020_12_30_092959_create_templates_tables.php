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

class CreateTemplatesTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('template_parameter', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->string('name', 100)->comment('名称');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id'], 'shop_id');
        });

        Schema::create('template_parameter_options', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parameter_id', false, true);
            $table->string('option', 100)->comment('选项名称');
            $table->text('values')->comment('选项值');
            $table->tinyInteger('type')->default(0)->comment('类型 0:单选,1:多选,2:输入');
            $table->tinyInteger('sorting', false, true)->default(0)->comment('排序');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['parameter_id'], 'parameter_id');
        });

        Schema::create('template_spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true)->default(0)->comment('店铺id 0:系统');
            $table->string('name', 50)->comment('名称');
            $table->tinyInteger('sorting', false, true)->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id', 'status'], 'shop_id');
            $table->index(['name', 'status'], 'name');
        });

        Schema::create('template_spec_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('spec_id', false, true);
            $table->string('value', 100);
            $table->tinyInteger('sorting', false, true)->default(0);
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['spec_id', 'status'], 'spec_id');
        });

        \Hyperf\DbConnection\Db::statement("ALTER TABLE `template_parameter` COMMENT '模版-商品参数'");
        \Hyperf\DbConnection\Db::statement("ALTER TABLE `template_parameter_options` COMMENT '模版-商品参数选项'");
        \Hyperf\DbConnection\Db::statement("ALTER TABLE `template_spec` COMMENT '模版-商品规格'");
        \Hyperf\DbConnection\Db::statement("ALTER TABLE `template_spec_value` COMMENT '模版-商品规格值'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_parameter');
        Schema::dropIfExists('template_parameter_options');
        Schema::dropIfExists('template_spec');
        Schema::dropIfExists('template_spec_value');
    }
}
