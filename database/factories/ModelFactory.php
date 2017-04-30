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
        'cellulaire' => $faker->phoneNumber,
        'adresse' => $faker->address,
        'ville' => $faker->city,
        'province' => $faker->country,
        'code_postal' => $faker->postcode,
        'email' => $faker->unique()->safeEmail,
        'naissance' => $faker->dateTime,
        'quartier_id' => App\Quartier::inRandomOrder()->first(),
        'inscription' => $faker->dateTime,
        'accepte_ca' => $faker->dateTime,
        'remarque' => $faker->paragraph(2),
    ];
});

$factory->define(App\Beneficiaire::class, function (Faker\Generator $faker) {

    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'telephone' => $faker->phoneNumber,
        'telephone2' => $faker->phoneNumber,
        'cellulaire' => $faker->phoneNumber,
        'adresse' => $faker->address,
        'ville' => $faker->city,
        'province' => $faker->country,
        'code_postal' => $faker->postcode,
        'email' => $faker->unique()->safeEmail,
        'naissance' => $faker->dateTime,
        'quartier_id' => App\Quartier::inRandomOrder()->first(),
        'conjoint' => $faker->name,
        'remarque' => $faker->paragraph(1),
        'resource_nom' => $faker->name,
        'resource_tel_maison' => $faker->phoneNumber,
        'resource_tel_bureau' => $faker->phoneNumber,
        'resource_tel_cel' => $faker->phoneNumber,
        'resource_tel_pager' => $faker->phoneNumber,
        'resource_email' => $faker->email,
        'resource2_nom' => $faker->name,
        'resource2_tel_maison' => $faker->phoneNumber,
        'resource2_tel_bureau' => $faker->phoneNumber,
        'resource2_tel_cel' => $faker->phoneNumber,
        'resource2_tel_pager' => $faker->phoneNumber,
        'resource2_email' => $faker->email,
    ];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
    return [
        'benevole_id' => function () {
            return factory('App\Benevole')->create()->id;
        },
        'beneficiaire_id' => function () {
            return factory('App\Beneficiaire')->create()->id;
        },
        'service_type_id' => function () {
            return App\ServiceType::inRandomOrder()->first();
        },
        'rendu_le' => $faker->date(),
        'don' => $faker->randomFloat(2, 0, 1000),

    ];
});
