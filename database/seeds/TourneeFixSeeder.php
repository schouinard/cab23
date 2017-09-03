<?php

use Illuminate\Database\Seeder;
use App\Beneficiaire;
use App\Tournee;

class TourneeFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Tournee::all() as $tournee)
        {
            foreach (Beneficiaire::all()->where('tournee_id', $tournee->id) as $beneficiaire)
            {
                $tournee->addBeneficiaire($beneficiaire->id, $beneficiaire->tournee_priorite, $beneficiaire->tournee_payee, $beneficiaire->tournee_note);
            }
        }
    }
}
