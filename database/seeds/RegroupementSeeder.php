<?php

use Illuminate\Database\Seeder;

class RegroupementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'CAB Aide 23',
            'CBC',
            'CDCB',
            'RLCB',
            'ROSPAB',
            'Aucun',
            'Autre'
        ];

        foreach ($items as $item) {
            App\Regroupement::create(['nom' => $item]);
        }
    }
}
