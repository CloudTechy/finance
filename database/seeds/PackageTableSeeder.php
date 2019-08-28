<?php

use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Package::class, 2)->create();
	}
}
