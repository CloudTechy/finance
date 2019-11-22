<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(UserLevelTableSeeder::class);
		$this->call(BankTableSeeder::class);
		$this->call(UserTableSeeder::class);
		//$this->call(PortfolioTableSeeder::class);
		//$this->call(PackageTableSeeder::class);
		//$this->call(TransactionTableSeeder::class);
		$this->call(PackageUserTableSeeder::class);
		//$this->call(WithdrawalTableSeeder::class);
	}
}
