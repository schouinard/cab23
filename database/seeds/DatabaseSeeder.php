<?php

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
        $this->seedStaticTables();

        $this->seedSuperAdmin();

        if (getenv('APP_ENV') == 'local') {
            $this->seedTestData();
        }
    }

    public function seedSuperAdmin()
    {
        $user = App\User::create([
            'name' => 'cab23',
            'email' => 'cab23@cab23.com',
            'password' => bcrypt('1qaz2wsx'),
            'isAdmin' => true,
        ]);
    }

    public function seedStaticTables()
    {
        $this->seedServiceTypes();
        $this->seedSecteurs();
        $this->seedClienteles();
        $this->seedIncomeSources();
        $this->seedRequestStatuses();
    }

    public function seedServiceTypes()
    {
        $serviceTypes = [
            'Accompagnement à la marche',
            'Accompagnement (transport adapté, taxi et autres)',
            'Accompagnement/transport',
            'Dépannage',
            'Dîner-rencontre',
            'Gardiennage',
            'Popote roulante',
            'Service téléphonique',
            'Aide aux devoirs',
            'Télé - bonjour',
            'Travail de bureau',
            'Visite d’amitié',
            'Autre service',
        ];
        foreach ($serviceTypes as $serviceType) {
            App\ServiceType::create(['nom' => $serviceType]);
        }
    }

    public function seedSecteurs()
    {
        $secteurs = [
            'Ile d\'Orléans',
            'Côte de Beauport',
            'Ville de Québec',
            'Charlesbourg',
            'Limoilou',
            'Beauport',
            'Courville',
            'Giffard',
            'Montmorency',
            'N-D de L\'Espérance',
            'St-Thérèse',
            'Villeneuve',
            'Ste-Brigitte de Laval',
        ];
        foreach ($secteurs as $secteur) {
            App\Secteur::create(['nom' => $secteur]);
        }
    }

    public function seedClienteles()
    {
        $clienteles = [
            'Famille/couple',
            'Handicap physique',
            'Dépendance',
            'Femmes',
            'Handicap intellectuel',
            'Services aux organismes',
            'Hommes',
            'Santé mentale',
            'Adolescent',
            'Problème de santé',
            'Enfants',
            'Immigrant',
            'Ainé(e)s',
            'Pauvreté et exclusion',
        ];
        foreach ($clienteles as $clientele) {
            App\Clientele::create(['nom' => $clientele]);
        }
    }

    public function seedIncomeSources()
    {
        $incomeSources = [
            'Sécurité de vieillesse',
            'Supplément de revenu garanti',
            'Sécurité sociale',
            'Curateur public du Québec',
            'RRQ',
            'Autre',
        ];

        foreach ($incomeSources as $incomeSource) {
            App\IncomeSource::create(['nom' => $incomeSource]);
        }
    }

    public function seedRequestStatuses()
    {
        $statuses = [
            'Non demandé',
            'En attente',
            'En cours',
            'Terminé / Annulé',
        ];

        foreach ($statuses as $status) {
            App\ServiceRequestStatus::create(['nom' => $status]);
        }
    }

    public function seedTestData()
    {
        $benevoles = factory('App\Benevole', 50)->create();
        foreach ($benevoles as $benevole) {
            factory('App\Service')->create([
                'benevole_id' => $benevole->id,
                'service_type_id' => App\ServiceType::inRandomOrder()->first()->id,
            ]);
            $benevole->clienteles()->attach([1, 3, 5]);
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
