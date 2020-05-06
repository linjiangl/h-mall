<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slide', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('shop_id', false, true);
			$table->string('title', 50);
			$table->string('image', 255)->default('')->comment('背景图');
			$table->string('url', 255)->default('');
			$table->smallInteger('position')->default(0)->comment('排序 倒叙');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide');
    }
}
