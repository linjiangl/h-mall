<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://store.yii.red
 * @document https://document.store.yii.red
 * @contact  8257796@qq.com
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateLogAdminLoginTable extends Migration
{
    protected $table = 'log_admin_login';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_admin_login', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('admin_id', false, true);
            $table->string('username', 30)->comment('管理员用户名');
            $table->string('client_ip', 30);
            $table->string('user_agent', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['admin_id'], 'admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_admin_login');
    }
}
