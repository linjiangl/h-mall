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

class CreateGoodsTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50);
            $table->string('logo', 255);
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已失效, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);
        });

        Schema::create('spec', function (Blueprint $table) {
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

        Schema::create('spec_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('spec_id', false, true);
            $table->string('value', 100);
            $table->tinyInteger('sorting', false, true)->default(0);
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['spec_id', 'status'], 'spec_id');
        });

        Schema::create('parameter', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->string('name', 100)->comment('名称');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id'], 'shop_id');
        });

        Schema::create('parameter_options', function (Blueprint $table) {
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

        Schema::create('category', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id', false, true)->default(0);
            $table->string('name', 100)->comment('名称');
            $table->string('icon', 255)->default('')->comment('图标');
            $table->string('cover', 255)->default('')->comment('封面图');
            $table->tinyInteger('sorting', false, true)->default(0);
            $table->tinyInteger('status')->default(0)->comment('是否显示 -1:已删除 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['parent_id', 'status'], 'parent_id');
            $table->index(['name', 'status'], 'name');
        });

        Schema::create('category_spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('category_id', false, true);
            $table->integer('spec_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['category_id', 'spec_id'], 'category_spec_id');
            $table->index(['spec_id'], 'spec_id');
        });

        Schema::create('goods', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('user_id', false, true);
            $table->integer('category_id', false, true);
            $table->integer('brand_id', false, true)->default(0)->comment('品牌');
            $table->string('type', 30)->default('general')->comment('商品类型 general:普通, virtual:虚拟');
            $table->string('title', 100)->comment('标题');
            $table->string('sub_title', 255)->default('')->comment('副标题');
            $table->integer('sales', false, true)->default(0)->comment('销量');
            $table->integer('virtual_sales', false, true)->default(0)->comment('虚拟销量');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->decimal('min_price', 10, 2)->unsigned()->default(0)->comment('最小金额');
            $table->decimal('max_price', 10, 2)->unsigned()->default(0)->comment('最大金额');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已下架, 1:已上架');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示 0:不显示, 1:显示');
            $table->tinyInteger('is_on_shelf')->default(1)->comment('是否上架 0:放入仓库, 1:立即上架');
            $table->tinyInteger('is_consume_discount')->default(0)->comment('是否参与会员等级折扣 0:否,1:是');
            $table->tinyInteger('is_free_shipping')->default(1)->comment('是否包邮 0:否, 1:是');
            $table->decimal('achieve_amount', 5)->default(99)->comment('达到多少金额包邮');
            $table->tinyInteger('recommend_way')->default(0)->comment('推荐方式 0:无,1:新品,2:精品,3:推荐');
            $table->string('refund_type', 30)->default('money')->comment('退款类型 money:仅退款,all:退货退款,refuse:拒绝退款');
            $table->smallInteger('buy_max', false, true)->default(0)->comment('限购 0:不限制');
            $table->smallInteger('buy_min', false, true)->default(0)->comment('起售 0:不限制');
            $table->string('video_url', 255)->comment('视频地址');
            $table->string('images', 1000)->comment('商品图片');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['user_id'], 'user_id');
            $table->index(['category_id'], 'category_id');
            $table->index(['brand_id'], 'brand_id');
            $table->index(['title'], 'title');
            $table->index(['sales'], 'sales');
            $table->index(['clicks'], 'clicks');
            $table->index(['min_price'], 'min_price');
            $table->index(['max_price'], 'max_price');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('goods_attribute', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('goods_id', false, true);
            $table->string('goods_unit', 30)->default('')->comment('商品单位');
            $table->string('goods_service_ids', 255)->default('')->comment('商品服务');
            $table->text('parameter')->comment('商品参数');
            $table->mediumText('goods_content')->comment('商品详情');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['goods_id'], 'goods_id');
        });

        Schema::create('goods_timer', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('goods_id', false, true);
            $table->tinyInteger('on', false, true)->default(0)->comment('定时上架');
            $table->tinyInteger('off', false, true)->default(0)->comment('定时下架');
            $table->integer('on_time', false, true)->default(0);
            $table->integer('off_time', false, true)->default(0);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['goods_id'], 'goods_id');
            $table->index(['on_time'], 'on_time');
            $table->index(['off_time'], 'off_time');
        });

        Schema::create('goods_spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('goods_id', false, true);
            $table->integer('spec_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['goods_id', 'spec_id'], 'goods_spec_id');
            $table->index(['spec_id'], 'spec_id');
        });

        Schema::create('goods_sku', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('shop_id', false, true);
            $table->integer('goods_id', false, true);
            $table->integer('coupon_id', false, true)->default(0)->comment('优惠券ID');
            $table->decimal('price', 10, 2)->unsigned()->default(0)->comment('金额');
            $table->decimal('original_price', 10, 2)->unsigned()->default(0)->comment('原价');
            $table->integer('stock', false, true)->default(0)->comment('库存');
            $table->integer('sales', false, true)->default(0)->comment('销量');
            $table->integer('clicks', false, true)->default(0)->comment('点击量');
            $table->string('image', 255)->default('')->comment('图片');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['goods_id'], 'goods_id');
            $table->index(['coupon_id'], 'coupon_id');
            $table->index(['price'], 'price');
            $table->index(['stock'], 'stock');
            $table->index(['sales'], 'sales');
        });

        Schema::create('goods_sku_spec_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('goods_sku_id', false, true);
            $table->integer('spec_value_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['goods_sku_id', 'spec_value_id'], 'goods_sku_spec_value_id');
            $table->index(['spec_value_id'], 'spec_value_id');
        });

        Schema::create('goods_service', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name', 100)->comment('商品服务名称');
            $table->text('description')->comment('商品服务的描述');
            $table->tinyInteger('sorting', false, true)->default(0)->comment('排序');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);
        });

        Schema::create('goods_parameter', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('goods_id', false, true);
            $table->string('option', 30);
            $table->string('value', 100);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['goods_id'], 'goods_id');
        });

        Schema::create('goods_appraises', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('order_id', false, true);
            $table->integer('order_goods_id', false, true);
            $table->integer('goods_id', false, true);
            $table->integer('goods_sku_id', false, true);
            $table->tinyInteger('score', false, true)->default(0)->comment('评分');
            $table->integer('top', false, true)->default(0)->comment('点赞');
            $table->integer('reply_num', false, true)->default(0)->comment('回复数量');
            $table->integer('additional_num', false, true)->default(0)->comment('追评数量');
            $table->integer('additional_appraises_id', false, true)->default(0)->comment('追评ID');
            $table->tinyInteger('is_additional', false, true)->default(0)->comment('是否追加评价 0:否,1:是');
            $table->tinyInteger('is_image', false, true)->default(0)->comment('是否带图 0:否,1:是');
            $table->tinyInteger('is_anonymous', false, true)->default(0)->comment('是否匿名 0:否,1:是');
            $table->string('content', 255)->comment('评论内容');
            $table->string('images', 1000)->default('')->comment('评论图片');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['order_goods_id', 'status'], 'order_goods_id');
            $table->index(['order_id', 'status'], 'order_id');
            $table->index(['user_id', 'status'], 'user_id');
            $table->index(['goods_id', 'top', 'status'], 'goods_id_top');
        });

        Schema::create('goods_appraises_reply', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('appraises_id', false, true)->comment('评价ID');
            $table->integer('goods_id', false, true);
            $table->integer('goods_sku_id', false, true);
            $table->integer('user_id', false, true)->comment('回复评价的用户ID');
            $table->integer('reply_user_id', false, true)->default(0)->comment('被回复评价的用户ID');
            $table->integer('top', false, true)->default(0)->comment('点赞');
            $table->string('content', 255)->comment('评论内容');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:待审核, 1:已通过, 2:未通过');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['appraises_id'], 'appraises_id');
            $table->index(['goods_id', 'top'], 'goods_id_top');
        });

        Db::statement("ALTER TABLE `brand` COMMENT '商品品牌'");
        Db::statement("ALTER TABLE `spec` COMMENT '商品規格'");
        Db::statement("ALTER TABLE `spec_value` COMMENT '商品规格值'");
        Db::statement("ALTER TABLE `parameter` COMMENT '商品参数'");
        Db::statement("ALTER TABLE `parameter_options` COMMENT '商品参数选项'");
        Db::statement("ALTER TABLE `category` COMMENT '商品分类'");
        Db::statement("ALTER TABLE `category_spec` COMMENT '商品分类-关联的商品规格'");
        Db::statement("ALTER TABLE `goods` COMMENT '商品'");
        Db::statement("ALTER TABLE `goods_attribute` COMMENT '商品属性'");
        Db::statement("ALTER TABLE `goods_timer` COMMENT '商品定时'");
        Db::statement("ALTER TABLE `goods_spec` COMMENT '商品规格项'");
        Db::statement("ALTER TABLE `goods_sku` COMMENT '商品规格'");
        Db::statement("ALTER TABLE `goods_sku_spec_value` COMMENT '商品规格值'");
        Db::statement("ALTER TABLE `goods_service` COMMENT '商品服务'");
        Db::statement("ALTER TABLE `goods_parameter` COMMENT '商品参数'");
        Db::statement("ALTER TABLE `goods_appraises` COMMENT '商品评价'");
        Db::statement("ALTER TABLE `goods_appraises_reply` COMMENT '商品评价回复'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand');
        Schema::dropIfExists('spec');
        Schema::dropIfExists('spec_value');
        Schema::dropIfExists('parameter');
        Schema::dropIfExists('parameter_options');
        Schema::dropIfExists('category');
        Schema::dropIfExists('category_spec');
        Schema::dropIfExists('goods');
        Schema::dropIfExists('goods_attribute');
        Schema::dropIfExists('goods_timer');
        Schema::dropIfExists('goods_spec');
        Schema::dropIfExists('goods_sku');
        Schema::dropIfExists('goods_sku_spec_value');
        Schema::dropIfExists('goods_service');
        Schema::dropIfExists('goods_parameter');
        Schema::dropIfExists('goods_appraises');
        Schema::dropIfExists('goods_appraises_reply');
    }
}
