<?php

namespace Tests\Unit;

use App\Adress;
use App\Benevole;
use App\IncomeSource;
use App\Person;
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
            'competence_id' => 1,
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
            'competence_id' => 1,
            'service_request_status_id' => 1,
            'beneficiaire_id' => $this->beneficiaire->id,
        ]);

        $this->assertCount(1, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_can_add_a_service_request()
    {
        $this->beneficiaire->addServiceRequests(1, [
            'service_request_status_id' => 1,
        ]);
        $this->assertCount(1, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_cannot_add_the_same_service_request_twice()
    {
        $this->beneficiaire->addServiceRequests(1, [
            'service_request_status_id' => 1,
        ]);
        $this->beneficiaire->addServiceRequests(1, [
            'service_request_status_id' => 1,
        ]);
        $this->assertCount(1, $this->beneficiaire->serviceRequests);
    }

    /** @test */
    public function it_can_add_multiple_service_requests_at_the_same_time()
    {
        $this->beneficiaire->addServiceRequests(
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
        $this->beneficiaire->addAutonomies(1);
        $this->assertCount(1, $this->beneficiaire->autonomies);
    }

    /** @test */
    public function it_cannot_add_the_same_autonomie_twice()
    {
        $this->beneficiaire->addAutonomies(1);
        $this->beneficiaire->addAutonomies(1);
        $this->assertCount(1, $this->beneficiaire->autonomies);
    }

    /** @test */
    public function it_can_add_multiple_autonomies_at_the_same_time()
    {
        $this->beneficiaire->addAutonomies(
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

        $this->assertCount(1, $this->beneficiaire->etatsSante);
    }

    /** @test */
    public function it_can_add_etat_sante()
    {
        $this->beneficiaire->addEtatsSante(1);
        $this->assertCount(1, $this->beneficiaire->etatsSante);
    }

    /** @test */
    function it_can_update_etat_sante()
    {
        $this->beneficiaire->addEtatsSante([1,2,3]);
        $this->beneficiaire->addEtatsSante([4,5]);

        $this->assertCount(2, $this->beneficiaire->etatsSante);
    }

    /** @test */
    public function it_cannot_add_the_same_etat_sante_twice()
    {
        $this->beneficiaire->addEtatsSante(1);
        $this->beneficiaire->addEtatsSante(1);
        $this->assertCount(1, $this->beneficiaire->etatsSante);
    }

    /** @test */
    public function it_can_add_multiple_etats_sante_at_the_same_time()
    {
        $this->beneficiaire->addEtatsSante(
            [
                1,
                2,
            ]
        );
        $this->assertCount(2, $this->beneficiaire->etatsSante);
    }

    /** @test */
    function it_can_add_an_adress()
    {
        $adress = raw(Adress::class);

        $this->beneficiaire->addAdress($adress);

        $this->assertInstanceOf(Adress::class, $this->beneficiaire->adress);
        $this->assertNotNull($this->beneficiaire->adress);
    }

    /** @test */
    function it_can_add_people()
    {
        $people = raw(Person::class, [
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw
            (Adress::class),
        ], 3);

        $this->beneficiaire->addPeople($people);

        $this->assertCount(3, $this->beneficiaire->people);
        $this->assertInstanceOf(Person::class, $this->beneficiaire->people->first());
    }

    /** @test */
    function it_can_have_income_source()
    {
        $this->assertInstanceOf(IncomeSource::class, $this->beneficiaire->income_source);
    }
}
