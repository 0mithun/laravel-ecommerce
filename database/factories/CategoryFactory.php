<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AppModelsCategory;
use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name'          =>  $faker->name(),
        'description'   =>  $faker->realText(100),
        'parent_id'     =>  1,
        'menu'          =>  1
    ];
});
