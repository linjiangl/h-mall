<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateLogSmsSendTable extends Migration
{
    protected $table = 'log_sms_send';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->tinyInteger('type')->default(0)->comment('短信类型 0:验证码');
            $table->string('mobile', 20);
            $table->string('content', 255)->comment('短信内容');
            $table->string('trade_no', 64)->default('')->comment('服务商返回的业务号');
            $table->string('module', 30)->default('account')->comment('模块 account:账号');
            $table->string('sub_module', 30)->default('register')->comment('子模块 register:注册');
            $table->smallInteger('status')->default(0)->comment('状态');
            $table->string('remark', 1000)->default('');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['mobile', 'type'], 'mobile_type');
            $table->index(['module'], 'module');
            $table->index(['sub_module'], 'sub_module');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
