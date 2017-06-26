<?php

use Illuminate\Database\Seeder;

class SecteursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secteurs = [
            'Ile d\'Orléans',
            'Côte de Beaupré',
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
}
