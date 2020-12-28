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
use Hyperf\DbConnection\Db;

class CreateAttachmentTable extends Migration
{
    protected $table = 'attachment';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('system', 50)->comment('云存储系统');
            $table->string('type', 50)->comment('文件类型');
            $table->bigInteger('size', false, true)->default(0)->comment('文件大小(字节)');
            $table->string('hash', 128)->default('');
            $table->string('key', 255)->default('');
            $table->string('index', 64)->comment('索引');
            $table->string('encrypt', 64)->default('')->comment('文件的 MD5 散列值');
            $table->tinyInteger('status')->default(1)->comment('状态 -1:已删除, 0:已失效, 1:已启用');
            $table->integer('created_time', false, true)->default(0);
            $table->integer('updated_time', false, true)->default(0);

            $table->unique(['index'], 'index');
            $table->index(['encrypt'], 'encrypt');
            $table->index(['created_time', 'status'], 'md5');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '附件'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
