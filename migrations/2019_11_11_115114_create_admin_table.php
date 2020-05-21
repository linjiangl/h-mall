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
            $table->string('username', 100)->comment('用户名');
            $table->string('mobile', 20)->default('')->comment('手机号');
            $table->string('name', 20)->default('')->comment('姓名');
            $table->string('avatar', 255)->default('')->comment('头像');
            $table->string('email', 100)->default('')->comment('邮箱');
            $table->string('password', 64);
            $table->string('salt', 24)->comment('加密盐');
            $table->tinyInteger('status')->default(1)->comment('状态 0:禁用,1:正常');
            $table->timestamps();
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
