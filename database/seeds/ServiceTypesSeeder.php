<?php

use Illuminate\Database\Seeder;

class ServiceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
}
