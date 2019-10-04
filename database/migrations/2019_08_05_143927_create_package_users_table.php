<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('package_user', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('package_id')->unsigned()->index();
			$table->bigInteger('user_id')->unsigned()->index();
			$table->decimal('account', 60, 2)->default(0);
			$table->timestamp('expiration')->nullable();
			$table->boolean('active')->default(true);
			$table->boolean('referral')->nullable();
			$table->bigInteger('transaction_id')->unsigned()->index();

			$table->timestamps();
			$table->foreign('package_id')->references('id')->on('packages');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('transaction_id')->references('id')->on('transactions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('package_user');
	}
}
