<?php

use Illuminate\Database\Seeder;

class BenevoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Bénévole du CAB',
            'Bénévole du milieu',
            'Membre honoraire',
        ];

        foreach ($types as $type) {
            \App\BenevoleType::create(['nom' => $type]);
        }
    }
}
