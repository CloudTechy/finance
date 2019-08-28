<?php

use App\Package;
use App\Transaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $package = Package::inRandomOrder()->first();
    $sent = $faker->boolean;
    $confirmed = $faker->boolean;
    if ($confirmed == false) {
        $sent = false;
    }
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'amount' => $package->deposit,
        'payment' => $package->deposit,
        'sent' => $sent,
        'confirmed' => $confirmed,
    ];
});
