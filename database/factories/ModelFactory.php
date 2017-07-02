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

$factory->define(App\Disponibilite::class, function () {
    $faker = Faker\Factory::create('fr_CA');

    return [
        'benevole_id' => function () {
            return factory(App\Benevole::class)->create()->id;
        },
        'day_id' => function () {
            return \App\Day::inRandomOrder()->first()->id;
        },
        'moment_id' => function () {
            return \App\Moment::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\Note::class, function () {
    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'date' => $faker->date(),
        'text' => $faker->paragraph,
        'title' => $faker->sentence,
        'notable_id' => function () {
            return factory(App\Benevole::class)->create()->id;
        },
        'notable_type' => App\Benevole::class,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'isAdmin' => false,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Benevole::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'adress_id' => function () {
            return factory('App\Adress')->create()->id;
        },
        'naissance' => $faker->dateTime->format('Y-m-d'),
        'inscription' => $faker->dateTime->format('Y-m-d'),
        'accepte_ca' => $faker->dateTime->format('Y-m-d'),
        'remarque' => $faker->paragraph(2),
        'antecedents' => $faker->paragraph,
        'enquete_sociale' => $faker->paragraph,
        'integration' => $faker->dateTime->format('Y-m-d'),
        'suivi' => $faker->dateTime->format('Y-m-d'),
        'benevole_type_id' => App\BenevoleType::inRandomOrder()->first(),
        'sexe' => $faker->randomElement(['Homme', 'Femme']),
    ];
});

$factory->define(App\Adress::class, function () {

    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'telephone' => '(418) 555-5555',
        'telephone2' => '(418) 555-5555 x1234',
        'cellulaire' => '(418) 555-5555',
        'adresse' => $faker->numberBetween(3, 2999).' '.$faker->streetName,
        'ville' => 'Québec',
        'province' => 'QC',
        'code_postal' => $faker->postcode,
        'email' => $faker->unique()->safeEmail,
        'secteur_id' => App\Secteur::inRandomOrder()->first()->id,
    ];
});

$factory->define(App\Beneficiaire::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'naissance' => $faker->dateTime->format('Y-m-d'),
        'conjoint' => $faker->name,
        'adress_id' => function () {
            return factory('App\Adress')->create()->id;
        },
        'remarque' => $faker->paragraph(20, true),
        'residence' => $faker->word,
        'occupation' => $faker->word,
        'evaluation_domicile' => $faker->date(),
        'premiere_demande' => $faker->date(),
        'income_source_id' => App\IncomeSource::inRandomOrder()->first()->id,
        'contribution_volontaire' => $faker->boolean,
        'visite_medicale' => $faker->boolean,
        'gratuite' => $faker->boolean,
        'accepte_sollicitation' => $faker->boolean,
        'etat_sante_autre' => $faker->paragraph(20, true),
        'autonomie_autre' => $faker->paragraph(20, true),
        'support_familial' => $faker->paragraph(20, true),
        'securite_sociale' => $faker->randomNumber(9, true),
        'curateur_public' => $faker->randomNumber(6, true),
        'autre_revenu' => $faker->word,
        'facturation_id' => function () {
            return factory('App\Adress')->create()->id;
        },
        'facturation_nom' => $faker->name,
        'tournee_payee' => $faker->boolean(),
        'tournee_note' => $faker->sentence(),
        'sexe' => $faker->randomElement(['Homme', 'Femme']),
    ];
});

$factory->define(App\Person::class, function () {

    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'nom' => $faker->name,
        'lien' => $faker->randomElement(['Fils', 'Fille', 'Soeur', 'Frère', 'Ami', 'Collègue', 'TS']),
        'contactable_id' => function () {
            return factory(App\Beneficiaire::class)->create()->id;
        },
        'contactable_type' => function () {
            return factory(App\Adress::class)->create()->id;
        },
    ];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'benevole_id' => function () {
            return factory('App\Benevole')->create()->id;
        },
        'serviceable_id' => function () {
            return factory('App\Beneficiaire')->create()->id;
        },
        'serviceable_type' => App\Beneficiaire::class,
        'competence_id' => function () {
            return App\Competence::inRandomOrder()->first()->id;
        },
        'rendu_le' => $faker->date(),
        'don' => $faker->randomFloat(2, 0, 1000),
        'heures' => $faker->randomFloat(2, 0, 1000),
    ];
});

$factory->define(App\Organisme::class, function () {
    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'nom' => $faker->company,
        'adress_id' => function () {
            return factory('App\Adress')->create()->id;
        },
        'type_id' => function () {
            return App\OrganismeType::inRandomOrder()->first()->id;
        },
        'secteur_id' => function () {
            return App\OrganismeSecteur::inRandomOrder()->first()->id;
        },
    ];
});

$factory->define(App\Tournee::class, function () {
    $faker = Faker\Factory::create('fr_CA'); // create a French faker

    return [
        'nom' => $faker->streetName,
        'telephone' => $faker->phoneNumber,
    ];
});
