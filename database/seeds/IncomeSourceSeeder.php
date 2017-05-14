<?php

use Illuminate\Database\Seeder;

class IncomeSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incomeSources = [
            'Sécurité de vieillesse',
            'Supplément de revenu garanti',
            'Sécurité sociale',
            'Curateur public du Québec',
            'RRQ',
            'Autre',
        ];

        foreach ($incomeSources as $incomeSource) {
            App\IncomeSource::create(['nom' => $incomeSource]);
        }
    }
}
