<?php

use App\Package;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PackageUserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$package = Package::inRandomOrder()->first();

		factory(App\Transaction::class, 1)->create(['amount' => $package->deposit, 'payment' => $package->deposit, 'reference' => 'SELF'])->each(function ($transaction) use ($package) {

			factory(App\PackageUser::class)->create(['transaction_id' => $transaction->id, 'package_id' => $package->id, 'user_id' => $transaction->user_id, 'account' => $package->deposit, 'expiration' => Carbon::now()->addDays($package->duration),
			]);
		});
	}
}
