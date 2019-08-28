<?php

use App\Bank;
use App\BankDetail;
use App\User;
use Faker\Generator as Faker;

$factory->define(BankDetail::class, function (Faker $faker) {
    return [
        'bank_id' => function () {

            return Bank::inRandomOrder()->first()->id;
        },
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },

        'acc_name' => $faker->name,
        'acc_number' => $faker->bankAccountNumber,
        'swift_code' => $faker->swiftBicNumber,
    ];
});
