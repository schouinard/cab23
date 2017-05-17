<?php

use Illuminate\Database\Seeder;

class OrganismeSecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Culture',
            'Loisirs communautaires',
            'Sociaux-communautaire',
            'Sport et plein air',
            'Autre',
        ];

        foreach ($items as $item) {
            App\OrganismeSecteur::create(['nom' => $item]);
        }
    }
}
