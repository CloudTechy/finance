<?php

use App\Package;
use App\User;
use App\Withdrawal;
use Faker\Generator as Faker;

$factory->define(Withdrawal::class, function (Faker $faker) {
	$package = Package::inRandomOrder()->first();
	$processed = $faker->boolean;
	$confirmed = $faker->boolean;
	if ($processed == false) {
		$confirmed = false;
	}
	return [
		'user_id' => function () {
			return User::inRandomOrder()->first()->id;
		},
		'processed' => $processed,
		'confirmed' => $confirmed,
		'amount' => $package->deposit,

	];
});
