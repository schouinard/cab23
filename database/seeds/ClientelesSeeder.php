<?php

use Illuminate\Database\Seeder;

class ClientelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clienteles = [
            'Familles/couples',
            'Handicap physique',
            'Dépendance',
            'Femmes',
            'Handicap intellectuel',
            'Services aux organismes',
            'Hommes',
            'Santé mentale',
            'Adolescents',
            'Problèmes de santé',
            'Enfants',
            'Immigrants',
            'Ainé(e)s',
            'Pauvreté et exclusion',
        ];
        foreach ($clienteles as $clientele) {
            App\Clientele::create(['nom' => $clientele]);
        }
    }
}
