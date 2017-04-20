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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Benevole::class, function (Faker\Generator $faker) {

    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'telephone' => $faker->phoneNumber,
        'telephone2' => $faker->phoneNumber,
        'addresse' => $faker->address,
        'ville' => $faker->city,
        'province' => $faker->country,
        'codePostal' => $faker->postcode,
        'email' => $faker->unique()->safeEmail,
        'naissance' => $faker->dateTime,
        'contactUrgenceNom' => $faker->name,
        'contactUrgenceTel' => $faker->phoneNumber,
    ];
});
