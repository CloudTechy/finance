<?php

use App\Withdrawal;
use Faker\Generator as Faker;

$factory->define(Withdrawal::class, function (Faker $faker) {
    return [
        'store_id' => $faker->numberBetween(1, 5),
        'processed' => $faker->boolean,
        'confirmed' => $faker->boolean,
        'amount' => $faker->randomNumber(5),
        'currency_code' => 'NGN',

    ];
});
