<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateExpressTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_express', function (Blueprint $table) {
			$table->smallIncrements('id');
			$table->string('name', 50)->comment('公司名称');
			$table->string('code', 50)->comment('公司编码');
			$table->smallInteger('position')->default(0)->comment('排序');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_express');
    }
}
