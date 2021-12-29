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
            $table->unsignedTinyInteger('sex')->default(0)->comment('性别 1:男, 2:女, 3:保密');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->string('password', 64)->comment('密码');
            $table->string('remember_token', 64)->default('');
            $table->string('salt', 24)->default('')->comment('加密盐');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用, 2:待审核');
            $table->unsignedTinyInteger('is_system')->default(0)->comment('是否系统用户');
            $table->unsignedInteger('lasted_login_time')->default(0)->comment('最后登录时间');
            $table->unsignedInteger('mobile_verified_time')->default(0)->comment('手机验证时间');
            $table->unsignedInteger('email_verified_time')->default(0)->comment('邮箱验证时间');
            $table->unsignedInteger('avatar_updated_time')->default(0)->comment('头像设置时间');
            $table->unsignedInteger('username_updated_time')->default(0)->comment('用户名设置时间');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['mobile'], 'mobile');
            $table->index(['email'], 'email');
            $table->unique(['username', 'status'], 'username');
            $table->index(['nickname', 'status'], 'nickname');
            $table->index(['lasted_login_time', 'status'], 'lasted_login_time');
            $table->index(['created_time', 'status'], 'created_time');

            $table->comment('用户');
        });

        Schema::create('user_wallet', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('integral')->default(0)->comment('积分');
            $table->decimal('balance', 10, 2)->default(0)->comment('余额');
            $table->unsignedInteger('freeze_integral')->default(0)->comment('冻结的积分');
            $table->decimal('freeze_balance', 10, 2)->default(0)->comment('冻结的余额');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['user_id'], 'user_id');
            $table->index(['integral'], 'integral');
            $table->index(['balance'], 'balance');

            $table->comment('用户钱包');
        });

        Schema::create('user_vip_card', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('serial_no', 20)->comment('会员卡号');
            $table->unsignedTinyInteger('grade')->default(1)->comment('会员等级');
            $table->unsignedInteger('total_exp')->default(0)->comment('总经验');
            $table->unsignedInteger('current_exp')->default(0)->comment('当前经验');
            $table->string('real_name', 20)->default('')->comment('真实姓名');
            $table->string('mobile', 20)->comment('手机号码');
            $table->string('id_card', 20)->default('')->comment('身份证号码');
            $table->string('password', 32)->default('')->comment('会员卡密码');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态 0:未激活, 1:已激活');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['serial_no'], 'serial_no');
            $table->index(['mobile'], 'mobile');
            $table->index(['id_card'], 'id_card');
            $table->index(['user_id', 'status'], 'user_id');
            $table->index(['grade', 'status'], 'grade');
            $table->index(['total_exp', 'status'], 'total_exp');
            $table->index(['created_time', 'status'], 'created_time');

            $table->comment('用户会员卡');
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('name', 30)->comment('姓名');
            $table->string('mobile', 20)->comment('手机号');
            $table->unsignedInteger('province_id');
            $table->string('province', 20)->comment('省');
            $table->unsignedInteger('city_id');
            $table->string('city', 20)->comment('市');
            $table->unsignedInteger('district_id');
            $table->string('district', 20)->comment('区');
            $table->unsignedInteger('street_id')->default(0);
            $table->string('street', 50)->default('')->comment('街道');
            $table->string('address', 150)->comment('地址');
            $table->string('zip_code', 20)->comment('邮政编码');
            $table->tinyInteger('is_default')->default(0)->comment('是否默认 0:否, 1:是');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['mobile'], 'mobile');
            $table->index(['user_id', 'is_default'], 'user_id_is_default');
            $table->index(['province_id'], 'province_id');
            $table->index(['city_id'], 'city_id');

            $table->comment('用户地址');
        });

        Schema::create('user_history', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['user_id', 'product_id'], 'user_id_product_id');

            $table->comment('用户浏览记录');
        });

        Schema::create('user_favorite', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('module', 30)->comment('模块 product:商品, shop:店铺');
            $table->unsignedInteger('module_id');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->unique(['user_id', 'module', 'module_id'], 'user_id_module_id');

            $table->comment('用户收藏');
        });

        Schema::create('user_invoice', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shop_id')->default(0);
            $table->unsignedTinyInteger('open_type')->default(1)->comment('开具类型 0:个人 1:企业');
            $table->unsignedTinyInteger('type')->default(0)->comment('发票类型 0:增值税普通发票 1:增值税专用发票 2:组织(非企业)增值税普通发票');
            $table->string('title', 150)->comment('发票抬头');
            $table->string('taxpayer_no', 30)->comment('纳税人识别号');
            $table->string('register_address', 100)->comment('注册地址');
            $table->string('register_phone', 30)->comment('注册电话');
            $table->string('bank_name', 100)->comment('开户银行');
            $table->string('bank_account', 100)->comment('银行账号');
            $table->unsignedTinyInteger('content_type')->default(0)->comment('发票内容 0:商品明细');
            $table->string('email', 50)->default('')->comment('邮箱');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态 0:已禁用, 1:已启用');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);

            $table->index(['user_id', 'status'], 'user_id');

            $table->comment('用户发票');
        });

        Schema::create('user_statement', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('type', 30)->comment('类型 recharged:充值 consumed:消费');
            $table->decimal('amount', 9)->default(0)->comment('金额');
            $table->integer('integral')->default(0)->comment('积分');
            $table->string('description', 100)->default('')->comment('描述');
            $table->string('module', 30)->default('')->comment('模块 order:订单');
            $table->unsignedInteger('module_id')->default(0);
            $table->string('remark', 255)->default('');
            $table->unsignedInteger('created_time')->default(0);
            $table->unsignedInteger('updated_time')->default(0);
            $table->unsignedInteger('deleted_time')->default(0);

            $table->index(['user_id', 'type'], 'user_id_type');
            $table->index(['created_time'], 'created_time');

            $table->comment('用户流水');
        });
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
