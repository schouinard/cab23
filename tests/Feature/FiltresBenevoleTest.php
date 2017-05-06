<?php

namespace Tests\Feature;

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

        $bornInJanuary = create('App\Benevole', ['naissance' => Carbon::create(null, 1, 1)]);
        $bornInMarch = create('App\Benevole', ['naissance' => Carbon::create(null, 3, 1)]);

        $this->get('benevoles?anniversaire=01')
             ->assertSee(htmlentities($bornInJanuary->nom, ENT_QUOTES))
             ->assertDontSee(htmlentities($bornInMarch->nom, ENT_QUOTES));
    }

    /** @test */
    public function a_user_can_filter_by_secteur()
    {
        $this->signIn();
        $benevole = create('App\Benevole', ['secteur_id' => 1]);
        $benevoleWithOtherSecteur = create('App\Benevole', ['secteur_id' => 2]);

        $this->get('benevoles?secteur=1')
             ->assertSee(htmlentities($benevole->nom, ENT_QUOTES))
             ->assertDontSee(htmlentities($benevoleWithOtherSecteur->nom, ENT_QUOTES));
    }

    /** @test */
    public function a_user_can_filter_and_get_all_statuses()
    {
        $this->signIn();
        $item = create('App\Benevole');
        $deletedItem = create('App\Benevole');
        $deletedItem->delete();

        $this->get('benevoles?statut=Tous')
            ->assertSee($item->nom)
            ->assertSee($deletedItem->nom);
    }

    /** @test */
    public function a_user_can_filter_and_get_only_trashed()
    {
        $this->signIn();
        $item = create('App\Benevole');
        $deletedItem = create('App\Benevole');
        $deletedItem->delete();

        $this->get('benevoles?statut=Inactifs')
            ->assertDontSee($item->nom)
            ->assertSee($deletedItem->nom);
    }

    /** @test */
    public function a_user_can_filter_by_inscription_year()
    {
        $this->signIn();
        $benevole = create('App\Benevole', ['inscription' => '1985-10-10']);
        $benevoleWithOtherYear = create('App\Benevole', ['inscription' => '1989-10-10']);

        $this->get('benevoles?inscription=1985')
            ->assertSee($benevole->inscription->format('Y-m-d'))
            ->assertDontSee($benevoleWithOtherYear->inscription->format('Y-m-d'));
    }

    /** @test */
    public function a_user_can_filter_by_accepte_ca()
    {
        $this->signIn();
        $benevole = create('App\Benevole', ['accepte_ca' => '1985-10-10']);
        $benevoleProbation = create('App\Benevole', ['accepte_ca' => null]);

        $this->get('benevoles?accepte_ca=accepte')
            ->assertSee($benevole->accepte_ca->format('Y-m-d'))
            ->assertDontSee($benevoleProbation->nom);

        $this->get('benevoles?accepte_ca=probation')
            ->assertSee($benevoleProbation->nom)
            ->assertDontSee($benevole->nom);
    }

}
