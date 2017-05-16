<?php

use Illuminate\Database\Seeder;

class InteretsCompetencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
            $categorie = \App\Category::create(['nom' => $key]);
            foreach ($group['Interets'] as $interet) {
                $categorie->interets()->create(['nom' => $interet]);
            }
            foreach ($group['Competences'] as $competence) {
                $categorie->competences()->create(['nom' => $competence]);
            }
        }
    }
}
