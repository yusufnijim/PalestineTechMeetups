<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User\UserModel::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->email,
        'password' => bcrypt($faker->text()),
    ];
});


$factory->define(App\Models\Event\EventModel::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(10),
        'body' => $faker->text(400),
        'permalink' => $faker->text(20),

        'max_registrars_count' => rand(1, 999),
        'is_registration_open' => $faker->boolean(),
        'is_published' => $faker->boolean(),
        'location' => $faker->address,
        'date' => $faker->dateTime(),
    ];
});


$factory->define(App\Models\BlogModel::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(10),
        'permalink' => $faker->text(20),
        'body' => $faker->text(400),
        'is_published' => $faker->boolean(),
    ];
});

