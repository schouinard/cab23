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
        $benevoles = factory('App\Benevole', 50)->create();
        $beneficiaires = factory('App\Beneficiaire', 50)->create();

        foreach ($benevoles as $benevole) {
            factory('App\Service')->create([
                'benevole_id' => $benevole->id,
                'service_type_id' => App\ServiceType::inRandomOrder()->first()->id,
                'beneficiaire_id' => random_int(1, 50),
            ]);
            $benevole->clienteles()->attach([1, 3, 5]);
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
                'beneficiaire_id' => null,
                'adress_id' => null,
                'adress' => raw
                (Adress::class),
            ], 3);
            $beneficiaire->addPeople($people);
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
