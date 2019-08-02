<?php

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $types = ['POS', 'Exchange'];
    return [
        'store_id' => $faker->numberBetween(1, 5),
        'amount' => $faker->randomNumber(5),
        'sent' => $faker->boolean,
        'confirmed' => $faker->boolean,
        'reference' => $faker->uuid,
        'customer_name' => $faker->name,
        'currency_code' => 'NGN',
        'type' => $types[array_rand($types)],
    ];
});
