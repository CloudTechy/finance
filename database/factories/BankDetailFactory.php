<?php

use App\Bank;
use App\BankDetail;
use Faker\Generator as Faker;

$factory->define(BankDetail::class, function (Faker $faker) {
    return [
        'bank_id' => function () {

            return factory(Bank::class)->create()->id;
        },
        'account_name' => $faker->name,
        'account_number' => $faker->bankAccountNumber,
    ];
});
