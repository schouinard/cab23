<?php

namespace Tests\Feature;

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

        $this->get('benevoles?anniversaire=01')
             ->assertSee(webformat($bornInJanuary->nom))
             ->assertDontSee(webformat($bornInMarch->nom));
    }

    /** @test */
    public function a_user_can_filter_by_secteur()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['secteur_id' => 1]);
        $benevoleWithOtherSecteur = create(Benevole::class, ['secteur_id' => 2]);

        $this->get('benevoles?secteur=1')
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

        $this->get('benevoles?statut=Tous')
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

        $this->get('benevoles?statut=Inactifs')
            ->assertDontSee(webformat($item->nom))
            ->assertSee(webformat($deletedItem->nom));
    }

    /** @test */
    public function a_user_can_filter_by_inscription_year()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['inscription' => '1985-10-10']);
        $benevoleWithOtherYear = create(Benevole::class, ['inscription' => '1989-10-10']);

        $this->get('benevoles?inscription=1985')
            ->assertSee($benevole->inscription->format('Y-m-d'))
            ->assertDontSee($benevoleWithOtherYear->inscription->format('Y-m-d'));
    }

    /** @test */
    public function a_user_can_filter_by_accepte_ca()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['accepte_ca' => '1985-10-10']);
        $benevoleProbation = create(Benevole::class, ['accepte_ca' => null]);

        $this->get('benevoles?accepte_ca=accepte')
            ->assertSee($benevole->accepte_ca->format('Y-m-d'))
            ->assertDontSee(webformat($benevoleProbation->nom));

        $this->get('benevoles?accepte_ca=probation')
            ->assertSee(webformat($benevoleProbation->nom))
            ->assertDontSee(webformat($benevole->nom));
    }

}
