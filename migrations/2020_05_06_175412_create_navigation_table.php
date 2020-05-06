<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navigation', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->string('title', 50);
			$table->string('url', 255)->default('');
			$table->tinyInteger('status')->default(0)->comment('状态 0:关闭, 1:开启');
			$table->smallInteger('position')->default(0)->comment('排序');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation');
    }
}
