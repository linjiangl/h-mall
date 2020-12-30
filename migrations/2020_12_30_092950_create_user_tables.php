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

class CreateUserTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('username', 30)->comment('用户名');
            $table->string('nickname', 50)->comment('昵称');
            $table->string('mobile', 20)->default('')->comment('手机');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->tinyInteger('sex', false, true)->default(0)->comment('性别 1:男, 2:女, 3:保密');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->string('password', 64)->comment('密码');
            $table->string('remember_token', 64)->default('');
            $table->string('salt', 24)->default('')->comment('加密盐');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用, 2:待审核');
            $table->tinyInteger('is_system', false, true)->default(0)->comment('是否系统用户');
            $table->integer('lasted_login_time', false, true)->default(0)->comment('最后登录时间');
            $table->integer('mobile_verified_time', false, true)->default(0)->comment('手机验证时间');
            $table->integer('email_verified_time', false, true)->default(0)->comment('邮箱验证时间');
            $table->integer('avatar_updated_time', false, true)->default(0)->comment('头像设置时间');
            $table->integer('username_updated_time', false, true)->default(0)->comment('用户名设置时间');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['mobile'], 'mobile');
            $table->index(['email'], 'email');
            $table->unique(['username', 'status'], 'username');
            $table->index(['nickname', 'status'], 'nickname');
            $table->index(['lasted_login_time', 'status'], 'lasted_login_time');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('user_wallet', function (Blueprint $table) {
            $table->integer('user_id', false, true);
            $table->integer('integral', false, true)->default(0)->comment('积分');
            $table->decimal('balance', 10, 2)->default(0)->comment('余额');
            $table->integer('freeze_integral', false, true)->default(0)->comment('冻结的积分');
            $table->decimal('freeze_balance', 10, 2)->default(0)->comment('冻结的余额');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['user_id'], 'user_id');
            $table->index(['integral'], 'integral');
            $table->index(['balance'], 'balance');
        });

        Schema::create('user_vip_card', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('serial_no', 20)->comment('会员卡号');
            $table->tinyInteger('grade', false, true)->default(1)->comment('会员等级');
            $table->integer('total_exp', false, true)->default(0)->comment('总经验');
            $table->integer('current_exp', false, true)->default(0)->comment('当前经验');
            $table->string('real_name', 20)->default('')->comment('真实姓名');
            $table->string('mobile', 20)->comment('手机号码');
            $table->string('id_card', 20)->default('')->comment('身份证号码');
            $table->string('password', 32)->default('')->comment('会员卡密码');
            $table->tinyInteger('status')->default(0)->comment('状态 -1:已删除, 0:未激活, 1:已激活');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['serial_no'], 'serial_no');
            $table->index(['mobile'], 'mobile');
            $table->index(['id_card'], 'id_card');
            $table->index(['user_id', 'status'], 'user_id');
            $table->index(['grade', 'status'], 'grade');
            $table->index(['total_exp', 'status'], 'total_exp');
            $table->index(['created_time', 'status'], 'created_time');
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('name', 30)->comment('姓名');
            $table->string('mobile', 20)->comment('手机号');
            $table->integer('province_id', false, true);
            $table->string('province', 20)->comment('省');
            $table->integer('city_id', false, true);
            $table->string('city', 20)->comment('市');
            $table->integer('district_id', false, true);
            $table->string('district', 20)->comment('区');
            $table->integer('street_id', false, true)->default(0);
            $table->string('street', 50)->default('')->comment('街道');
            $table->string('address', 150)->comment('地址');
            $table->string('zip_code', 20)->comment('邮政编码');
            $table->tinyInteger('is_default')->default(0)->comment('是否默认 0:否, 1:是');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['mobile'], 'mobile');
            $table->index(['user_id', 'is_default'], 'user_id_is_default');
            $table->index(['province_id'], 'province_id');
            $table->index(['city_id'], 'city_id');
        });

        Schema::create('user_history', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('goods_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['user_id', 'goods_id'], 'user_id_goods_id');
        });

        Schema::create('user_favorite', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('module', 30)->comment('模块 goods:商品, shop:店铺');
            $table->integer('module_id', false, true);
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['user_id', 'module', 'module_id'], 'user_id_module_id');
        });

        Schema::create('user_invoice', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->integer('shop_id', false, true)->default(0);
            $table->tinyInteger('open_type', false, true)->default(1)->comment('开具类型 0:个人 1:企业');
            $table->tinyInteger('type', false, true)->default(0)->comment('发票类型 0:增值税普通发票 1:增值税专用发票 2:组织(非企业)增值税普通发票');
            $table->string('title', 150)->comment('发票抬头');
            $table->string('taxpayer_no', 30)->comment('纳税人识别号');
            $table->string('register_address', 100)->comment('注册地址');
            $table->string('register_phone', 30)->comment('注册电话');
            $table->string('bank_name', 100)->comment('开户银行');
            $table->string('bank_account', 100)->comment('银行账号');
            $table->tinyInteger('content_type', false, true)->default(0)->comment('发票内容 0:商品明细');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已禁用, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['user_id', 'status'], 'user_id');
        });

        Schema::create('user_statement', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id', false, true);
            $table->string('type', 30)->comment('类型 recharged:充值 consumed:消费');
            $table->decimal('amount', 9, 2)->default(0)->comment('金额');
            $table->integer('integral')->default(0)->comment('积分');
            $table->string('description', 100)->default('')->comment('描述');
            $table->string('module', 30)->default('')->comment('模块 order:订单');
            $table->integer('module_id', false, true)->default(0);
            $table->string('remark', 255)->default('');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->index(['user_id', 'type'], 'user_id_type');
            $table->index(['created_time'], 'created_time');
        });

        Db::statement("ALTER TABLE `user` COMMENT '用户'");
        Db::statement("ALTER TABLE `user_wallet` COMMENT '用户钱包'");
        Db::statement("ALTER TABLE `user_vip_card` COMMENT '用户会员卡'");
        Db::statement("ALTER TABLE `user_address` COMMENT '用户地址'");
        Db::statement("ALTER TABLE `user_history` COMMENT '用户浏览记录'");
        Db::statement("ALTER TABLE `user_favorite` COMMENT '用户收藏'");
        Db::statement("ALTER TABLE `user_invoice` COMMENT '用户发票'");
        Db::statement("ALTER TABLE `user_statement` COMMENT '用户流水'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('user_wallet');
        Schema::dropIfExists('user_vip_card');
        Schema::dropIfExists('user_address');
        Schema::dropIfExists('user_history');
        Schema::dropIfExists('user_favorite');
        Schema::dropIfExists('user_invoice');
        Schema::dropIfExists('user_statement');
    }
}
