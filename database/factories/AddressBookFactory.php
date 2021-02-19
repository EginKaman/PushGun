<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AddressBook;
use Faker\Generator as Faker;

$factory->define(AddressBook::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'name' => $faker->word
    ];
});
