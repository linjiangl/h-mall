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

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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
            $table->timestamps();

            $table->index(['user_id', 'is_default'], 'user_id_is_default');
            $table->index(['mobile'], 'mobile');
            $table->index(['province_id'], 'province_id');
            $table->index(['city_id'], 'city_id');

            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
}
