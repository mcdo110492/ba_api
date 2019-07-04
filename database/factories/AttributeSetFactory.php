<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AttributeSet;
use Faker\Generator as Faker;

$factory->define(AttributeSet::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->name,
        'project_id' => function(){
            return factory(\App\Projects::class)->create()->id;
        }
    ];
});
