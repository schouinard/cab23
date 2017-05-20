<?php

namespace Tests\Feature;

use App\Adress;
use App\Benevole;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FiltresBenevoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_filter_by_naissance_month()
    {
        $this->signIn();

        $bornInJanuary = create(Benevole::class, ['naissance' => Carbon::create(null, 1, 1)]);
        $bornInMarch = create(Benevole::class, ['naissance' => Carbon::create(null, 3, 1)]);

        $this->put('benevoles', ['anniversaire' => '01'])
             ->assertSee(webformat($bornInJanuary->nom))
             ->assertDontSee(webformat($bornInMarch->nom));
    }

    /** @test */
    public function a_user_can_filter_by_secteur()
    {
        $this->signIn();

        $adress1 = create(Adress::class, ['secteur_id' => 1]);
        $adress2 = create(Adress::class, ['secteur_id' => 2]);

        $benevole = create(Benevole::class, ['adress_id' => $adress1->id]);
        $benevoleWithOtherSecteur = create(Benevole::class, ['adress_id' => $adress2->id]);

        $this->put('benevoles', ['secteur'=>'1'])
             ->assertSee(webformat($benevole->nom))
             ->assertDontSee(webformat($benevoleWithOtherSecteur->nom));
    }

    /** @test */
    public function a_user_can_filter_and_get_all_statuses()
    {
        $this->signIn();
        $item = create(Benevole::class);
        $deletedItem = create(Benevole::class);
        $deletedItem->delete();

        $this->put('benevoles', ['statut'=>'Tous'])
            ->assertSee(webformat($item->nom))
            ->assertSee(webformat($deletedItem->nom));
    }

    /** @test */
    public function a_user_can_filter_and_get_only_trashed()
    {
        $this->signIn();
        $item = create(Benevole::class);
        $deletedItem = create(Benevole::class);
        $deletedItem->delete();

        $this->put('benevoles', ['statut'=>'Inactifs'])
            ->assertDontSee(webformat($item->nom))
            ->assertSee(webformat($deletedItem->nom));
    }

    /** @test */
    public function a_user_can_filter_by_inscription_year()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['inscription' => '1985-10-10']);
        $benevoleWithOtherYear = create(Benevole::class, ['inscription' => '1989-10-10']);

        $this->put('benevoles', ['inscription'=>'1985'])
            ->assertSee($benevole->inscription)
            ->assertDontSee($benevoleWithOtherYear->inscription);
    }

    /** @test */
    public function a_user_can_filter_by_accepte_ca()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['accepte_ca' => '1985-10-10']);
        $benevoleProbation = create(Benevole::class, ['accepte_ca' => null]);

        $this->put('benevoles', ['accepte_ca'=>'accepte'])
            ->assertSee($benevole->accepte_ca)
            ->assertDontSee(webformat($benevoleProbation->nom));

        $this->put('benevoles', ['accepte_ca'=>'probation'])
            ->assertSee(webformat($benevoleProbation->nom))
            ->assertDontSee(webformat($benevole->nom));
    }

}
