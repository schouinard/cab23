<?php

namespace Tests\Feature;

use App\Beneficiaire;
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

        $bornInJanuary = create(Beneficiaire::class, ['naissance' => Carbon::create(null, 1, 1)]);
        $bornInMarch = create(Beneficiaire::class, ['naissance' => Carbon::create(null, 3, 1)]);

        $this->get('beneficiaires?anniversaire=01')
             ->assertSee(webformat($bornInJanuary->nom))
             ->assertDontSee(webformat($bornInMarch->nom));
    }

    /** @test */
    public function a_user_can_filter_by_secteur()
    {
        $this->signIn();
        $beneficiaire = create(Beneficiaire::class, ['secteur_id' => 1]);
        $beneficiaireWithOtherSecteur = create(Beneficiaire::class, ['secteur_id' => 2]);

        $this->get('beneficiaires?secteur=1')
             ->assertSee(webformat($beneficiaire->nom))
             ->assertDontSee(webformat($beneficiaireWithOtherSecteur->nom));
    }
}
