<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FiltresBeneficiaireTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_filter_by_naissance_month()
    {
        $this->signIn();

        $bornInJanuary = create('App\Beneficiaire', ['naissance' => Carbon::create(null, 1, 1)]);
        $bornInMarch = create('App\Beneficiaire', ['naissance' => Carbon::create(null, 3, 1)]);

        $this->get('beneficiaires?anniversaire=01')
             ->assertSee(htmlentities($bornInJanuary->nom, ENT_QUOTES))
             ->assertDontSee(htmlentities($bornInMarch->nom, ENT_QUOTES));
    }

    /** @test */
    public function a_user_can_filter_by_quartier()
    {
        $this->signIn();
        $beneficiaire = create('App\Beneficiaire', ['quartier_id' => 1]);
        $beneficiaireWithOtherQuartier = create('App\Beneficiaire', ['quartier_id' => 2]);

        $this->get('beneficiaires?quartier=1')
             ->assertSee(htmlentities($beneficiaire->nom, ENT_QUOTES))
             ->assertDontSee(htmlentities($beneficiaireWithOtherQuartier->nom, ENT_QUOTES));
    }
}
