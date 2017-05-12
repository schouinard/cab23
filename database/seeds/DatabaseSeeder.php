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
        $this->seedEtatsSante();
        $this->seedAutonomies();
        $this->seedBenevoleTypes();
        $this->seedInteretsCompetences();
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
            'Visite d\'amitié',
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

    public function seedEtatsSante()
    {
        $etats = [
            'Déficience physique',
            'Déficience intellectuelle',
            'Démence',
            'Pertes cognitives',
            'Maladie mentale',
            'Convalescence',
        ];
        foreach ($etats as $etat) {
            App\EtatSante::create(['nom' => $etat]);
        }
    }

    public function seedAutonomies()
    {
        $autonomies = [
            'Marchette',
            'Canne',
            'Chaise roulante',
            'Handicap visuel',
            'Problème auditif',
            'Problème d\'élocution',
            'Troubles cognitifs',
            'Besoin d\'accompagnement',
        ];
        foreach ($autonomies as $autonomy) {
            \App\Autonomie::create(['nom' => $autonomy]);
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
            $beneficiaire->etats_sante()->attach([1, 3, 4]);
            $beneficiaire->autonomies()->attach([1, 2]);
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

    public function seedBenevoleTypes()
    {
        $types = [
            'Bénévole du CAB',
            'Bénévole du milieu',
            'Membre honoraire',
        ];

        foreach ($types as $type) {
            \App\BenevoleType::create(['nom' => $type]);
        }
    }

    public function seedInteretsCompetences()
    {
        $groups = [
            'Administration' => [
                'Interets' => [
                    'Siéger  CA',
                    'Comptabilité',
                    'Collecte de fonds',
                    'Siéger à un comité',
                    'Recherche de financement',
                ],
                'Competences' => [
                    'Connaissance en gestion administrative',
                    'Connaissance en comptabilité',
                    'Gestion des ressources humaines',
                    'Représenter une cause',
                ],
            ],
            'Événements' => [
                'Interets' => [
                    'Aide technique pour événements',
                    'Maquillages  / animations pour enfants',
                    'Animation d\'évènements',
                    'Organisation logistique (comité social, SAB, Salon des organismes)',
                    'Montage/démontage',
                    'Soutien au service alimentaire (BBQ, service des repas)',
                ],
                'Competences' => [
                    'Sens de l\'organisation',
                    'Sens de la priorisation',
                    'Force dans le travail d\'équipe',
                    'Capacités physiques',
                ],
            ],
            'Travail de bureau' => [
                'Interets' => [
                    'Service téléphonique',
                    'Secrétariat',
                    'Classement',
                    'Envois postaux',
                    'Archivage',
                ],
                'Competences' => [
                    'Habileté informatique',
                    'Français parlé et écrit',
                    'Anglais parlé et écrit',
                    'Autres langues',
                ],
            ],
            'Informatique et multimédia' => [
                'Interets' => [
                    'Informatique',
                    'Mise à jour d\'informations',
                ],
                'Competences' => [
                    'Formation',
                    'Soutien technique',
                    'Développement Web',
                    'Gestion site internet',
                    'Saisies de données',
                ],
            ],
            'Communication et marketing' => [
                'Interets' => [
                    'Bulletin de liaison le Cabotin / bon Appétit',
                    'Rédaction/ révision de textes',
                    'Entrevues et rédactions',
                    'Tenue de kiosques',
                    'Entrevue radio/télé',
                    'Ventre de produits promo',
                ],
                'Competences' => [
                    'Mise en page',
                    'Français oral',
                    'Français écrit',
                    'Graphisme',
                    'infographie',
                    'Prise de parole en public',
                ],
            ],
            'Apprentissages, formation et animation' => [
                'Interets' => [
                    'Formation',
                    'Animation de groupe',
                    'Animation d\'Activités',
                    'Coaching individuel',
                    'Aide aux devoirs',
                    'Lecteur/lectrice (Lire et faire lire)',
                ],
                'Competences' => [
                    'Elaborer une formation',
                    'Donner la formation',
                    'Facilité à parler en groupe',
                    'Capacité d\'analyse des situations',
                    'Gérer situation conflictuelle',
                ],
            ],
            'Arts, culture, sport et loisirs' => [
                'Interets' => [
                    'Aide technique pour événements extérieurs (sportifs ou culturels)',
                    'Maquillages  / animations pour enfants',
                    'Montage d\'exposition',
                    'Présence lors d\'exposition',
                    'Présence lors de courses sportives',
                    'Sport et loisirs',
                ],
                'Competences' => [],
            ],
            'Services aux personnes' => [
                'Interets' => [
                    'Accompagnement à la marche',
                    'Gardiennage',
                    'Popote roulante conducteur',
                    'Remplaçant conducteur',
                    'Popote roulante baladeur',
                    'Remplaçant baladeur',
                    'Dîner-rencontre',
                    'Télé-bonjour',
                    'Visite d\'amitié',
                    'Aide individuelle/ intervention',
                    'Écoute téléphonique',
                ],
                'Competences' => [
                    'Travail individuel',
                    'Travail en équipe',
                    'Empathie',
                ],
            ],
            'Transport' => [
                'Interets' => [
                    'Accompagnement (transport adapté, taxi et autres)',
                    'Accompagnement/transport',
                    'Livraison du repas pour Diner-rencontre',
                    'Transport des bénéficiaires pour diner-rencontre',
                    'Livraison du Cabotin ou autre communications',
                ],
                'Competences' => [
                    'Habiletés relationnelle',
                    'Assurance auto valide',
                ],
            ],
            'Divers' => [
                'Interets' => [
                    'Dépannage',
                    'Cuisine',
                    'Travaux manuels',
                    'Friperie',
                    'Aide au formulaire',
                    'Photographie',
                    'Vidéo',
                    'Distribution alimentaire',
                    'Implication ponctuelle pour une cause',
                ],
                'Competences' => [
                    'Travail individuel',
                    'Travail en équipe',
                    'Habiletés manuelles',
                ],
            ],

        ];

        foreach ($groups as $key => $group) {
            $categorie = \App\CategorieInteretCompetence::create(['nom' => $key]);
            foreach ($group['Interets'] as $interet) {
                $categorie->interets()->create(['nom' => $interet]);
            }
            foreach ($group['Competences'] as $competence) {
                $categorie->competences()->create(['nom' => $competence]);
            }
        }
    }
}
