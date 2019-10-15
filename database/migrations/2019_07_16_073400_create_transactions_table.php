<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('transactions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->decimal('amount', 60, 2)->default(0);
			$table->decimal('payment', 60, 2)->default(0);
			$table->boolean('sent')->default(false);
			$table->boolean('confirmed')->default(false);
			$table->string('reference')->nullable();
			$table->string('pop')->nullable();
			$table->boolean('active')->default(true);
			$table->string('currency_code')->index()->default('USD');

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
		Schema::dropIfExists('transactions');
	}
}
