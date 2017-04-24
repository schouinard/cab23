<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Benevole;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BenevoleTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function it_has_a_prenom()
    {
        $benevole = new Benevole(['prenom' => 'Stephane']);

        $this->assertEquals('Stephane', $benevole->prenom);
    }

    /** @test */
    function it_has_a_nom()
    {
        $benevole = new Benevole(['nom' => 'Chouinard']);

        $this->assertEquals('Chouinard', $benevole->nom);
    }

    /** @test */
    function it_has_a_telephone()
    {
        $benevole = new Benevole(['telephone' => '4188888888']);

        $this->assertEquals('4188888888', $benevole->telephone);
    }

    /** @test */
    function it_has_a_telephone2()
    {
        $benevole = new Benevole(['telephone2' => '4188888888']);

        $this->assertEquals('4188888888', $benevole->telephone2);
    }

    /** @test */
    function it_has_an_adresse()
    {
        $benevole = new Benevole(['adresse' => '140 rue du pic']);

        $this->assertEquals('140 rue du pic', $benevole->adresse);
    }

    /** @test */
    function it_can_add_a_service()
    {
        $benevole = factory('App\Benevole')->create();
        $benevole->addService([
            'type_id' => 1,
            'beneficiaire_id' => factory('App\Beneficiaire')->create()->id,
            'rendu_le' => Carbon::now()->toDateTimeString()
        ]);

        $this->assertCount(1, $benevole->services);
    }
}