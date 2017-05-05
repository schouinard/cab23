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
    public function a_user_can_filter_by_quartier()
    {
        $this->signIn();
        $benevole = create('App\Benevole', ['quartier_id' => 1]);
        $benevoleWithOtherQuartier = create('App\Benevole', ['quartier_id' => 2]);

        $this->get('benevoles?quartier=1')
             ->assertSee(htmlentities($benevole->nom, ENT_QUOTES))
             ->assertDontSee(htmlentities($benevoleWithOtherQuartier->nom, ENT_QUOTES));
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

}
