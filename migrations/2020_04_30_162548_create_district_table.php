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

class CreateDistrictTable extends Migration
{
    protected $table = 'district';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('parent_id', false, true)->default(0);
            $table->string('name', 50);
            $table->timestamps();

            $table->index(['parent_id'], 'parent_id');
            $table->index(['name'], 'name');
        });

        Db::statement("ALTER TABLE `{$this->table}` COMMENT '地区'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
