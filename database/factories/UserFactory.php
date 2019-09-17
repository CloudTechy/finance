<?php

use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'username' => $faker->unique()->word,
		'wallet' => $faker->creditCardNumber,
		'email' => $faker->unique()->safeEmail,
		'user_level_id' => $faker->numberBetween(1, 2),
		'email_verified_at' => now(),
		'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
		'remember_token' => str_random(10),
		'api_token' => $faker->unique()->bothify('#???##?#?#??#?##?#???#?#??#?#??#?#?#??#?##?#??#?#??#?###??##'),

	];
});
