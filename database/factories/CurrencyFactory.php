<?php
use App\Currency;
use Faker\Generator as Faker;

$factory->define(Currency::class, function (Faker $faker) {
	return [
		"code" => "NGN",
		"name" => "Naira",
	];
});
