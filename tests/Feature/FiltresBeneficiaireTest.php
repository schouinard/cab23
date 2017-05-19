<?php

namespace Tests\Feature;

use App\Adress;
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

        $this->put('beneficiaires' ,['anniversaire'=>'01'])
             ->assertSee(webformat($bornInJanuary->nom))
             ->assertDontSee(webformat($bornInMarch->nom));
    }

    /** @test */
    public function a_user_can_filter_by_secteur()
    {
        $this->signIn();
        $adress1 = create(Adress::class, ['secteur_id' => 1]);
        $adress2 = create(Adress::class, ['secteur_id' => 2]);

        $beneficiaire = create(Beneficiaire::class, ['adress_id' => $adress1->id]);
        $beneficiaireWithOtherSecteur = create(Beneficiaire::class, ['adress_id' => $adress2->id]);

        $this->put('beneficiaires' ,['secteur'=>'1'])
             ->assertSee(webformat($beneficiaire->nom))
             ->assertDontSee(webformat($beneficiaireWithOtherSecteur->nom));
    }
}
