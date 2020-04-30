<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateOptionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('option', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('shop_id', false, true);
			$table->string('name', 50)->comment('名称');
			$table->tinyInteger('position', false, true)->default(0);
			$table->timestamps();

			$table->index(['shop_id'], 'shop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option');
    }
}
