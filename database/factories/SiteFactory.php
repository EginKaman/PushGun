<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use Faker\Generator as Faker;

$factory->define(Site::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'link' => 'https://'.$faker->unique()->domainName,
        'visit' => $faker->numberBetween(0, 5),
        'delay' => $faker->numberBetween(0, 5),
        'mobile' => $faker->boolean,
        'hint' => $faker->boolean,
        'script' => $faker->unique()->url
    ];
});
