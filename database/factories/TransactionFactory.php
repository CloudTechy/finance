<?php

use App\Transaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
	// $sent = $faker->boolean;
	// $confirmed = $faker->boolean;
	// if ($confirmed == true) {
	// 	$sent = true;
	// }
	return [
		'user_id' => function () {
			return User::inRandomOrder()->first()->id;
		},
		'sent' => true,
		'confirmed' => true,
	];
});
