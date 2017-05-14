<?php

use Illuminate\Database\Seeder;

class EtatsSanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
}
