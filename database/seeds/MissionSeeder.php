<?php

use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Sociocommunautaire',
            'Sport et plein air',
            'Loisirs',
            'Culture',
            'Éducation',
            'Autre'
        ];

        foreach ($items as $item) {
            App\Mission::create(['nom' => $item]);
        }
    }
}
