<?php

use Illuminate\Database\Seeder;

class AutonomieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
            'Déambulateur',
        ];
        foreach ($autonomies as $autonomy) {
            \App\Autonomie::create(['nom' => $autonomy]);
        }
    }
}
