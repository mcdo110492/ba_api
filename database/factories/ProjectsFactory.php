<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Projects::class, function (Faker $faker) {
    return [
        'code' => str_random(),
        'project' => $faker->company
    ];
});
