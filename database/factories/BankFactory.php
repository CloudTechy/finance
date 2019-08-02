<?php

use App\Bank;
use Faker\Generator as Faker;

$factory->define(Bank::class, function (Faker $faker) {
	$banks = ['GTBank', 'Access', 'Diamond', 'Polaris', 'UBA', 'First Bank'];
	return [
		'name' => $banks[array_rand($banks)],
	];
});