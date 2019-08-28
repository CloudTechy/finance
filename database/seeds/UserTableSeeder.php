<?php

use App\BankDetail;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		factory(App\User::class, 10)->create()->each(function ($user) {

			factory(BankDetail::class)->create(['user_id' => $user->id]);

		});
	}
}
