<?php

namespace Tests\Unit;

use App\Service;
use App\Beneficiaire;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeneficiaireTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_have_services()
    {
        $beneficiaire = new Beneficiaire([
            'nom' => 'UnNom',
            'prenom' => 'UnPrenom',
            'courriel' => 'UnCourriel@courriel.com',
        ]);

        $service = new Service();

        $beneficiaire->services->add($service);

        $this->assertCount(1, $beneficiaire->services);
    }

    /** @test */
    function it_can_add_a_service()
    {
        $beneficiaire = factory('App\Beneficiaire')->create();
        $beneficiaire->addService([
            'service_type_id' => 1,
            'don' => 0,
            'benevole_id' => factory('App\Benevole')->create()->id,
            'rendu_le' => Carbon::now()->toDateTimeString(),
        ]);

        $this->assertCount(1, $beneficiaire->services);
    }
}
