<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'address_book_id' => $faker->numberBetween(1, 15),
        'address' => $faker->email
    ];
});
