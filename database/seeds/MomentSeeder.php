<?php

use Illuminate\Database\Seeder;

class MomentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'AM',
            'PM',
            'Soir',
        ];

        foreach ($items as $item) {
            App\Moment::create(['nom' => $item]);
        }
    }
}
