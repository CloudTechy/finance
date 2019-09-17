<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Package;
use App\PackageUser;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(PackageUser::class, function (Faker $faker) {
	$package = Package::inRandomOrder()->first();
	$current = Carbon::now();
	return [
		// 'package_id' => $package->id,
		// 'user_id' => $user->id,
		// 'account' => $package->deposit,
		// 'expiration' => $current->addDays($package->duration),
	];
});
