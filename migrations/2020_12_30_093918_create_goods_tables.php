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
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已失效, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);
        });

        Schema::create('spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺id 0:系统');
            $table->string('name', 50)->comment('名称');
            $table->unsignedTinyInteger('sorting')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['shop_id', 'name'], 'shop_id_name');
        });

        Schema::create('spec_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('spec_id');
            $table->string('value', 100);
            $table->unsignedTinyInteger('sorting')->default(0);
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['spec_id', 'status'], 'spec_id');
        });

        Schema::create('parameter', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id');
            $table->string('name', 100)->comment('名称');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['shop_id'], 'shop_id');
        });

        Schema::create('parameter_options', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('parameter_id');
            $table->string('option', 100)->comment('选项名称');
            $table->text('values')->comment('选项值');
            $table->tinyInteger('type')->default(0)->comment('类型 0:单选,1:多选,2:输入');
            $table->unsignedTinyInteger('sorting')->default(0)->comment('排序');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['parameter_id'], 'parameter_id');
        });

        Schema::create('category', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->string('name', 100)->comment('名称');
            $table->string('icon', 255)->default('')->comment('图标');
            $table->string('cover', 255)->default('')->comment('封面图');
            $table->unsignedTinyInteger('sorting')->default(0);
            $table->unsignedTinyInteger('status')->default(0)->comment('是否显示 -1:已删除 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['parent_id', 'status'], 'parent_id');
            $table->index(['name', 'status'], 'name');
        });

        Schema::create('category_spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('spec_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['category_id', 'spec_id'], 'category_spec_id');
            $table->index(['spec_id'], 'spec_id');
        });

        Schema::create('goods', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id')->comment('所属分类');
            $table->unsignedInteger('brand_id')->default(0)->comment('品牌');
            $table->unsignedInteger('sku_id')->default(0);
            $table->string('name', 100)->comment('商品名称');
            $table->decimal('sale_price', 10)->unsigned()->default(0)->comment('销售价格');
            $table->decimal('market_price', 10)->unsigned()->default(0)->comment('划线价格');
            $table->decimal('cost_price', 10)->unsigned()->default(0)->comment('成本价');
            $table->decimal('achieve_price')->default(99)->comment('达到多少金额包邮');
            $table->unsignedInteger('stock')->default(0)->comment('商品库存（总和）');
            $table->unsignedInteger('stock_alarm')->default(0)->comment('库存预警');
            $table->string('introduction', 255)->default('')->comment('促销语');
            $table->string('keywords', 255)->default('')->comment('关键词');
            $table->string('type', 30)->default('general')->comment('商品类型 general:普通, virtual:虚拟');
            $table->unsignedInteger('clicks')->default(0)->comment('点击量');
            $table->unsignedInteger('sales')->default(0)->comment('销量');
            $table->unsignedInteger('virtual_sales')->default(0)->comment('虚拟销量');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态 -1:已删除 0:仓库中, 1:销售中');
            $table->tinyInteger('recommend_way')->default(0)->comment('推荐方式 0:无,1:新品,2:精品,3:推荐');
            $table->tinyInteger('is_on_sale')->default(0)->comment('是否销售 0:放入仓库, 1:立即销售');
            $table->tinyInteger('is_consume_discount')->default(0)->comment('是否参与会员等级折扣 0:否,1:是');
            $table->tinyInteger('is_free_shipping')->default(1)->comment('是否包邮 0:否, 1:是');
            $table->unsignedSmallInteger('buy_max')->default(0)->comment('限购 0:不限制');
            $table->unsignedSmallInteger('buy_min')->default(0)->comment('起售 0:不限制');
            $table->string('refund_type', 30)->default('money')->comment('退款类型 money:仅退款,all:退货退款,refuse:拒绝退款');
            $table->string('images', 1000)->comment('商品图片');
            $table->string('video_url', 255)->comment('视频地址');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['category_id'], 'category_id');
            $table->index(['brand_id'], 'brand_id');
            $table->index(['type'], 'type');
            $table->index(['keywords'], 'keywords');
            $table->index(['sale_price'], 'sale_price');
            $table->index(['sales'], 'sales');
            $table->index(['clicks'], 'clicks');
            $table->index(['stock'], 'stock');
            $table->index(['stock_alarm'], 'stock_alarm');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('goods_attribute', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('goods_id');
            $table->string('goods_unit', 30)->default('')->comment('商品单位');
            $table->decimal('goods_weight', 10)->unsigned()->default(0)->comment('重量（单位g）');
            $table->decimal('goods_volume', 10)->unsigned()->default(0)->comment('体积（单位立方米）');
            $table->string('goods_service_ids', 255)->default('')->comment('商品服务');
            $table->text('parameter')->comment('商品参数');
            $table->mediumText('goods_content')->comment('商品详情');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['goods_id'], 'goods_id');
        });

        Schema::create('goods_timer', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('goods_id');
            $table->unsignedTinyInteger('on')->default(0)->comment('定时上架');
            $table->unsignedTinyInteger('off')->default(0)->comment('定时下架');
            $table->unsignedInteger('on_time')->default(0);
            $table->unsignedInteger('off_time')->default(0);
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['goods_id'], 'goods_id');
            $table->index(['on_time'], 'on_time');
            $table->index(['off_time'], 'off_time');
        });

        Schema::create('goods_spec', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('goods_id');
            $table->unsignedInteger('spec_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['goods_id', 'spec_id'], 'goods_spec_id');
            $table->index(['spec_id'], 'spec_id');
        });

        Schema::create('goods_sku', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('goods_id');
            $table->string('sku_name', 255)->default('')->comment('商品sku名称');
            $table->string('sku_no', 64)->default('')->comment('商品sku编码');
            $table->decimal('sale_price', 10)->unsigned()->default(0)->comment('销售价格');
            $table->decimal('market_price', 10)->unsigned()->default(0)->comment('划线价格');
            $table->decimal('cost_price', 10)->unsigned()->default(0)->comment('成本价格');
            $table->unsignedInteger('stock')->default(0)->comment('库存');
            $table->unsignedInteger('stock_alarm')->default(0)->comment('库存预警');
            $table->unsignedInteger('clicks')->default(0)->comment('点击量');
            $table->unsignedInteger('sales')->default(0)->comment('销量');
            $table->unsignedInteger('virtual_sales')->default(0)->comment('虚拟销量');
            $table->string('image', 255)->default('')->comment('图片');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['shop_id'], 'shop_id');
            $table->index(['goods_id'], 'goods_id');
            $table->index(['sale_price'], 'sale_price');
            $table->index(['stock'], 'stock');
            $table->index(['sales'], 'sales');
            $table->index(['stock_alarm'], 'stock_alarm');
        });

        Schema::create('goods_sku_spec_value', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('goods_sku_id');
            $table->unsignedInteger('spec_value_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['goods_sku_id', 'spec_value_id'], 'goods_sku_spec_value_id');
            $table->index(['spec_value_id'], 'spec_value_id');
        });

        Schema::create('goods_service', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name', 100)->comment('商品服务名称');
            $table->text('description')->comment('商品服务的描述');
            $table->unsignedTinyInteger('sorting')->default(0)->comment('排序');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
        });

        Schema::create('goods_parameter', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('goods_id');
            $table->string('option', 30);
            $table->string('value', 100);
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['goods_id'], 'goods_id');
        });

        Schema::create('goods_appraises', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('order_goods_id');
            $table->unsignedInteger('goods_id');
            $table->unsignedInteger('goods_sku_id');
            $table->unsignedTinyInteger('score')->default(0)->comment('评分');
            $table->unsignedInteger('top')->default(0)->comment('点赞');
            $table->unsignedInteger('reply_num')->default(0)->comment('回复数量');
            $table->unsignedInteger('additional_num')->default(0)->comment('追评数量');
            $table->unsignedInteger('additional_appraises_id')->default(0)->comment('追评ID');
            $table->unsignedTinyInteger('is_additional')->default(0)->comment('是否追加评价 0:否,1:是');
            $table->unsignedTinyInteger('is_image')->default(0)->comment('是否带图 0:否,1:是');
            $table->unsignedTinyInteger('is_anonymous')->default(0)->comment('是否匿名 0:否,1:是');
            $table->string('content', 255)->comment('评论内容');
            $table->string('images', 1000)->default('')->comment('评论图片');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:待审核, 1:已通过, 2:未通过');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->unique(['order_goods_id', 'status'], 'order_goods_id');
            $table->index(['order_id', 'status'], 'order_id');
            $table->index(['user_id', 'status'], 'user_id');
            $table->index(['goods_id', 'top', 'status'], 'goods_id_top');
        });

        Schema::create('goods_appraises_reply', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('appraises_id')->comment('评价ID');
            $table->unsignedInteger('goods_id');
            $table->unsignedInteger('goods_sku_id');
            $table->unsignedInteger('user_id')->comment('回复评价的用户ID');
            $table->unsignedInteger('reply_user_id')->default(0)->comment('被回复评价的用户ID');
            $table->unsignedInteger('top')->default(0)->comment('点赞');
            $table->string('content', 255)->comment('评论内容');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:待审核, 1:已通过, 2:未通过');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

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
