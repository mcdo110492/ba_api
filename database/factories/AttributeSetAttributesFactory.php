<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\AttributeSetAttributes::class, function (Faker $faker) {
    return [
        'set_id' => function(){
            return factory(\App\AttributeSet::class)->create()->id;
        },
        'attr_id' => function(){
            return factory(\App\Attributes::class)->create()->id;
        }
    ];
});
