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

        $this->put('benevoles', ['secteur' => '1'])
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

        $this->put('benevoles', ['statut' => 'Tous'])
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

        $this->put('benevoles', ['statut' => 'Inactifs'])
            ->assertDontSee(webformat($item->nom))
            ->assertSee(webformat($deletedItem->nom));
    }

    /** @test */
    public function a_user_can_filter_by_inscription_year()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['inscription' => '1985-10-10']);
        $benevoleWithOtherYear = create(Benevole::class, ['inscription' => '1989-10-10']);

        $this->put('benevoles', ['inscription' => '1985'])
            ->assertSee($benevole->inscription)
            ->assertDontSee($benevoleWithOtherYear->inscription);
    }

    /** @test */
    public function a_user_can_filter_by_accepte_ca()
    {
        $this->signIn();
        $benevole = create(Benevole::class, ['accepte_ca' => '1985-10-10']);
        $benevoleProbation = create(Benevole::class, ['accepte_ca' => null]);

        $this->put('benevoles', ['accepte_ca' => 'accepte'])
            ->assertSee($benevole->accepte_ca)
            ->assertDontSee(webformat($benevoleProbation->nom));

        $this->put('benevoles', ['accepte_ca' => 'probation'])
            ->assertSee(webformat($benevoleProbation->nom))
            ->assertDontSee(webformat($benevole->nom));
    }

    /** @test */
    public function a_user_can_get_a_filtered_list_of_benevole_for_a_specific_day()
    {
        $this->signIn();
        $benevole_dispo_le_lundi = create(Benevole::class);
        $benevole_dispo_le_lundi->addDisponibilites([2 => [1, 2, 3]]);

        $benevole_dispo_le_mardi = create(Benevole::class);
        $benevole_dispo_le_mardi->addDisponibilites([3 => [1, 2, 3]]);

        $this->put('benevoles', ['dispojour' => 2])
            ->assertSee($benevole_dispo_le_lundi->nom)
            ->assertDontSee($benevole_dispo_le_mardi->nom);
    }

    /** @test */
    public function a_user_can_get_a_filtered_list_of_benevole_for_a_specific_moment()
    {
        $this->signIn();
        $benevole_dispo_le_matin = create(Benevole::class);
        $benevole_dispo_le_matin->addDisponibilites([2 => [1]]);

        $benevole_dispo_le_mardi_toute_journee = create(Benevole::class);
        $benevole_dispo_le_mardi_toute_journee->addDisponibilites([3 => [1, 2, 3]]);

        $this->put('benevoles', ['dispomoment' => 2])
            ->assertSee($benevole_dispo_le_mardi_toute_journee->nom)
            ->assertDontSee($benevole_dispo_le_matin->nom);
    }

    /** @test */
    public function a_user_can_filter_by_a_date_disponible()
    {
        $this->signIn();
        $benevoledispo = create(Benevole::class);

        $benevole_pas_dispo = create(Benevole::class);
        $benevole_pas_dispo->addIndisponibilite(Carbon::create(2017, 1, 1), Carbon::create(2017, 2, 1));

        $this->put('benevoles', ['isdispo' => '2017-01-15'])
            ->assertSee($benevoledispo->nom)
            ->assertDontSee($benevole_pas_dispo->nom);
    }
}
