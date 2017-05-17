<?php

use Illuminate\Database\Seeder;

class OrganismeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'CAB',
            'Milieu',
        ];

        foreach ($items as $item) {
            App\OrganismeType::create(['nom' => $item]);
        }
    }
}
