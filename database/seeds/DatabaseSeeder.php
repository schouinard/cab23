<?php

use App\Adress;
use App\Person;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (getenv('APP_ENV') == 'local') {
            $this->seedTestData();
        }
    }

    public function seedTestData()
    {
        $benevoles = factory(\App\Benevole::class, 50)->create();
        $beneficiaires = factory(\App\Beneficiaire::class, 50)->create();
        $organismes = factory(\App\Organisme::class, 50)->create();

        foreach ($benevoles as $benevole) {
            factory(\App\Service::class)->create([
                'benevole_id' => $benevole->id,
                'service_type_id' => App\ServiceType::inRandomOrder()->first()->id,
                'beneficiaire_id' => random_int(1, 50),
            ]);
            $benevole->clienteles()->attach([1, 3, 5]);
            $benevole->interets()->sync([
                1 => ['priority' => 1],
                2 => ['priority' => 2],
                3 => ['priority' => 3],
            ]);
            $benevole->competences()->sync([
                1 => ['priority' => 1],
                2 => ['priority' => 2],
                3 => ['priority' => 3],
            ]);
            $benevole->disponibilites()->createMany([
                [
                    'day_id' => 1,
                    'moment_id' => 1,
                ],
                [
                    'day_id' => 1,
                    'moment_id' => 2,
                ],
                [
                    'day_id' => 2,
                    'moment_id' => 3,
                ],
                [
                    'day_id' => 3,
                    'moment_id' => 1,
                ],
                [
                    'day_id' => 3,
                    'moment_id' => 2,
                ],
                [
                    'day_id' => 3,
                    'moment_id' => 3,
                ],
            ]);
            factory(\App\Note::class, random_int(5, 10))->create([
                'notable_id' => $benevole->id,
                'notable_type' => \App\Benevole::class,
            ]);
        }

        foreach ($beneficiaires as $beneficiaire) {
            $beneficiaire->addEtatsSante([1, 3, 4]);
            $beneficiaire->addAutonomies([1, 2]);
            $beneficiaire->addServiceRequests([
                1 => ['service_request_status_id' => 1],
                2 => ['service_request_status_id' => 2],
                3 => ['service_request_status_id' => 3],
            ]);
            $people = raw(Person::class, [
                'contactable_id' => null,
                'contactable_type' => null,
                'adress_id' => null,
                'adress' => raw
                (Adress::class),
            ], 3);
            $beneficiaire->addPeople($people);

            factory(\App\Note::class, random_int(5, 10))->create([
                'notable_id' => $beneficiaire->id,
                'notable_type' => \App\Beneficiaire::class,
            ]);
        }

        foreach($organismes as $organisme)
        {
            factory(\App\Note::class, random_int(5, 10))->create([
                'notable_id' => $organisme->id,
                'notable_type' => \App\Organisme::class,
            ]);
            $president = raw(Person::class, [
                'lien' => 'Président',
                'contactable_id' => null,
                'contactable_type' => null,
                'adress_id' => null,
                'adress' => raw
                (Adress::class),
            ]);
            $employe = raw(Person::class, [
                'lien' => 'Employé',
                'contactable_id' => null,
                'contactable_type' => null,
                'adress_id' => null,
                'adress' => raw
                (Adress::class),
            ]);

            $organisme->addPeople([$president, $employe]);
        }

        factory('App\User')->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'isAdmin' => true,
        ]);

        factory('App\User')->create([
            'name' => 'accueil',
            'email' => 'accueil@accueil.com',
            'password' => bcrypt('accueil'),
            'isAdmin' => false,
        ]);
    }
}
