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
}
