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

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('username', 30)->comment('用户名');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->string('real_name', 20)->default('')->comment('姓名');
            $table->string('mobile', 20)->default('')->comment('手机号');
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->string('password', 64);
            $table->string('salt', 24);
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->integer('lasted_login_time', false , true)->default(0)->comment('最后登录时间');
            $table->timestamps();

            $table->unique(['username'], 'username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
}
