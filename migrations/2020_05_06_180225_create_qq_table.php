<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateQqTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('qq', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('shop_id', false, true);
			$table->tinyInteger('type', false, true);
			$table->string('qq', 20);
			$table->string('name', 20);
			$table->string('remark', 255)->default('')->comment('备注');
			$table->tinyInteger('status')->default(0)->comment('状态 0:关闭, 1:开启');
			$table->timestamps();

			$table->index(['shop_id'], 'shop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qq');
    }
}
