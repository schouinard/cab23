<?php

use Illuminate\Database\Seeder;

class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Non demandé',
            'En attente',
            'En cours',
            'Terminé / Annulé',
        ];

        foreach ($statuses as $status) {
            App\ServiceRequestStatus::create(['nom' => $status]);
        }
    }
}
