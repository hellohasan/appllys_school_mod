<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Student::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->userName,
        'phone' => $faker->phoneNumber,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
