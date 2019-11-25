<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('withdrawals', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->bigInteger('amount');
			$table->string('currency_code')->index()->default('USD');
			$table->boolean('processed')->default(false);
			$table->boolean('confirmed')->default(false);
			$table->string('pop')->nullable();
			$table->string('reference')->default('SELF');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('withdrawals');
	}
}
