<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Package;
use App\Portfolio;
use Faker\Generator as Faker;

$factory->define(Package::class, function (Faker $faker) {
	$portfolio = $faker->randomElement(['bronze', 'silver', 'gold', 'platinum']);
	$bronze = $faker->unique()->randomElement(['20', '40', '80', '100', '150']);
	$silver = $faker->unique()->randomElement(['200', '500', '1000', '2000']);
	$gold = $faker->unique()->randomElement(['5000', '10000', '20000', '30000']);
	$platinum = $faker->unique()->randomElement(['60000', '100000', '200000']);
	$package = [];
	if ($portfolio == 'bronze') {
		$package['portfolio_id'] = Portfolio::where('name', 'bronze')->first()->id;
		$package['plan'] = $bronze;
		if ($bronze == '20') {
			$package['deposit'] = 20;
			$package['interest'] = 2;
			$package['duration'] = 3;
			$package['referral_commission'] = 0;
		} else if ($bronze == '40') {
			$package['deposit'] = 40;
			$package['interest'] = 5;
			$package['duration'] = 7;
			$package['referral_commission'] = 0;
		} else if ($bronze == '80') {
			$package['deposit'] = 80;
			$package['interest'] = 10;
			$package['duration'] = 14;
			$package['referral_commission'] = 0;
		} else if ($bronze == '100') {
			$package['deposit'] = 100;
			$package['interest'] = 12;
			$package['duration'] = 21;
			$package['referral_commission'] = 0;
		} else if ($bronze == '150') {
			$package['deposit'] = 150;
			$package['interest'] = 30;
			$package['duration'] = 30;
			$package['referral_commission'] = 0;
		}
	} else if ($portfolio == 'silver') {
		$package['portfolio_id'] = Portfolio::where('name', 'silver')->first()->id;
		$package['plan'] = $silver;
		if ($silver == '200') {
			$package['deposit'] = 200;
			$package['interest'] = 70;
			$package['duration'] = 30;
			$package['referral_commission'] = 5;
		} else if ($silver == '500') {
			$package['deposit'] = 500;
			$package['interest'] = 150;
			$package['duration'] = 30;
			$package['referral_commission'] = 5;
		} else if ($silver == '1000') {
			$package['deposit'] = 1000;
			$package['interest'] = 400;
			$package['duration'] = 30;
			$package['referral_commission'] = 5;
		} else if ($silver == '2000') {
			$package['deposit'] = 2000;
			$package['interest'] = 1000;
			$package['duration'] = 30;
			$package['referral_commission'] = 5;
		}
	} else if ($portfolio == 'gold') {
		$package['portfolio_id'] = Portfolio::where('name', 'gold')->first()->id;
		$package['plan'] = $gold;
		if ($gold == '5000') {
			$package['deposit'] = 5000;
			$package['interest'] = 2000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		} else if ($gold == '10000') {
			$package['deposit'] = 10000;
			$package['interest'] = 5000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		} else if ($gold == '20000') {
			$package['deposit'] = 20000;
			$package['interest'] = 10000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		} else if ($gold == '30000') {
			$package['deposit'] = 30000;
			$package['interest'] = 15000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		}
	} else if ($portfolio == 'platinum') {
		$package['portfolio_id'] = Portfolio::where('name', 'platinum')->first()->id;
		$package['plan'] = $platinum;
		if ($platinum == '60000') {
			$package['deposit'] = 60000;
			$package['interest'] = 20000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		} else if ($platinum == '100000') {
			$package['deposit'] = 100000;
			$package['interest'] = 50000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		} else if ($platinum == '200000') {
			$package['deposit'] = 200000;
			$package['interest'] = 70000;
			$package['duration'] = 30;
			$package['referral_commission'] = 10;
		}
	}
	return [
		'portfolio_id' => $package['portfolio_id'],
		'name' => $package['plan'],
		'deposit' => $package['deposit'],
		'interest_rate' => $package['interest'],
		'duration' => $package['duration'],
		'referral_commission' => $package['referral_commission'],

	];
});
