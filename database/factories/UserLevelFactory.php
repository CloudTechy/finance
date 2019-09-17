<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserLevel;
use Faker\Generator as Faker;

$factory->define(UserLevel::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array('administrator', 'user')),
		'role' => 'manages the website',
	];
});
