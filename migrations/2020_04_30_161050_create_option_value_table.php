<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateOptionValueTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('option_value', function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('option_id', false, true);
			$table->string('value', 100);
			$table->tinyInteger('position', false, true)->default(0);
			$table->timestamps();

			$table->index(['option_id'], 'option_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_value');
    }
}
