<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('username')->unique();
			$table->string('number')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->timestamp('email_verified_at')->nullable();
			$table->bigInteger('user_level_id')->unsigned()->index();
			$table->string('referral')->nullable();
			$table->integer('referral_count')->default(0);
			$table->string('api_token', 60)->unique()->nullable();
			$table->string('wallet')->nullable();
			$table->string('pm')->nullable();
			$table->string('ip')->nullable();
			$table->string('secret_question')->nullable();
			$table->string('secret_answer')->nullable();
			$table->string('admin_wallet')->nullable();
			$table->string('admin_pm')->nullable();
			$table->boolean('withdraw_request')->default(false);
			$table->rememberToken();
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
