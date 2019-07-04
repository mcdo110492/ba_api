<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Attributes;

use Faker\Generator as Faker;

$factory->define(Attributes::class, function (Faker $faker) {
    return [
        'attribute' => $faker->unique()->name,
        'is_native' => false
    ];
});
