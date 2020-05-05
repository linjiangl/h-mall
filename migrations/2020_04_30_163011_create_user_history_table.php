<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserHistoryTable extends Migration
{
	protected $table = 'user_history';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
			$table->integerIncrements('id');
			$table->integer('user_id', false, true);
			$table->integer('product_id', false, true);
			$table->timestamp('created_at')->nullable();

			$table->index(['user_id'], 'user_id');
        });

		\Hyperf\DbConnection\Db::statement("ALTER TABLE `{$this->table}` COMMENT '用户-浏览记录'");
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
