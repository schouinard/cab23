<?php

namespace Tests\Unit;

use App\Benevole;
use App\Service;
use App\Beneficiaire;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeneficiaireTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  \App\Beneficiaire */
    protected $beneficiaire;

    public function setUp()
    {
        parent::setUp();
        $this->beneficiaire = create(Beneficiaire::class);
    }

    /** @test */
    public function it_can_have_services()
    {
        $service = new Service();

        $this->beneficiaire->services->add($service);

        $this->assertCount(1, $this->beneficiaire->services);
    }

    /** @test */
    function it_can_add_a_service()
    {
        $this->beneficiaire->addService([
            'service_type_id' => 1,
            'don' => 0,
            'benevole_id' => create(Benevole::class)->id,
            'rendu_le' => Carbon::now()->toDateTimeString(),
        ]);

        $this->assertCount(1, $this->beneficiaire->services);
    }

    /** @test */
    public function it_can_have_requested_services()
    {
        DB::table('service_requests')->insert([
            'beneficiaire_id' => $this->beneficiaire->id,
            'service_type_id' => 1,
            'service_request_status_id' => 1,
        ]);

        $this->assertCount(1, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_can_add_a_service_request()
    {
        $this->beneficiaire->addServiceRequest(1, [
            'service_request_status_id' => 1,
        ]);
        $this->assertCount(1, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_cannot_add_the_same_service_request_twice()
    {
        $this->beneficiaire->addServiceRequest(1, [
            'service_request_status_id' => 1,
        ]);
        $this->beneficiaire->addServiceRequest(1, [
            'service_request_status_id' => 1,
        ]);
        $this->assertCount(1, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_can_add_multiple_service_requests_at_the_same_time()
    {
        $this->beneficiaire->addServiceRequest(
            [
                1 => ['service_request_status_id' => 1],
                2 => ['service_request_status_id' => 1],
            ]
        );
        $this->assertCount(2, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_can_have_autonomies()
    {
        DB::table('autonomie_beneficiaire')->insert([
            'beneficiaire_id' => $this->beneficiaire->id,
            'autonomie_id' => 1,
        ]);

        $this->assertCount(1, $this->beneficiaire->autonomies);
    }

    /** @test */
    public function it_can_add_autonomie()
    {
        $this->beneficiaire->addAutonomie(1);
        $this->assertCount(1, $this->beneficiaire->autonomies);
    }

    /** @test */
    public function it_cannot_add_the_same_autonomie_twice()
    {
        $this->beneficiaire->addAutonomie(1);
        $this->beneficiaire->addAutonomie(1);
        $this->assertCount(1, $this->beneficiaire->autonomies);
    }

    /** @test */
    public function it_can_add_multiple_autonomies_at_the_same_time()
    {
        $this->beneficiaire->addAutonomie(
            [
                1,
                2,
            ]
        );
        $this->assertCount(2, $this->beneficiaire->autonomies);
    }

    /** @test */
    public function it_can_have_etats_sante()
    {
        DB::table('beneficiaire_etat_sante')->insert([
            'beneficiaire_id' => $this->beneficiaire->id,
            'etat_sante_id' => 1,
        ]);

        $this->assertCount(1, $this->beneficiaire->etats_sante);
    }

    /** @test */
    public function it_can_add_etat_sante()
    {
        $this->beneficiaire->addEtatSante(1);
        $this->assertCount(1, $this->beneficiaire->etats_sante);
    }

    /** @test */
    public function it_cannot_add_the_same_etat_sante_twice()
    {
        $this->beneficiaire->addEtatSante(1);
        $this->beneficiaire->addEtatSante(1);
        $this->assertCount(1, $this->beneficiaire->etats_sante);
    }

    /** @test */
    public function it_can_add_multiple_etats_sante_at_the_same_time()
    {
        $this->beneficiaire->addEtatSante(
            [
                1,
                2,
            ]
        );
        $this->assertCount(2, $this->beneficiaire->etats_sante);
    }
}
