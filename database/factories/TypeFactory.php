<?php

use App\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {
    $types = ['POS', 'Exchange'];

    return [
        'type' => $types[array_rand($types)],
    ];
});
