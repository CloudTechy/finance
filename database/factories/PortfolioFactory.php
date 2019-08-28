<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Portfolio;
use Faker\Generator as Faker;

$factory->define(Portfolio::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->randomElement($array = array('bronze', 'silver', 'gold', 'platinum')),
    ];
});
