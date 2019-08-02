<?php

use App\BankDetail;
use App\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
	return [

		'name' => $faker->company,
		'address' => $faker->address,
		'phone_number' => $faker->phoneNumber,
		'bank_details_id' => function () {
			return factory(BankDetail::class)->create()->id;
		},
		'pending_balance' => $faker->randomNumber(5),

	];
});
