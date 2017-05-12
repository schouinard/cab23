<?php

namespace Tests\Unit;

use App\Beneficiaire;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Benevole;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BenevoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  Benevole */
    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->benevole = create(Benevole::class);
    }

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
    function it_can_add_a_service()
    {
        $benevole = create(Benevole::class);
        $benevole->addService([
            'service_type_id' => 1,
            'don' => 10,
            'beneficiaire_id' => create(Beneficiaire::class)->id,
            'rendu_le' => Carbon::now()->toDateTimeString(),
        ]);

        $this->assertCount(1, $benevole->services);
    }

    /** @test */
    public function it_can_have_clienteles()
    {
        DB::table('benevole_clientele')->insert([
            'benevole_id' => $this->benevole->id,
            'clientele_id' => 1,
        ]);

        $this->assertCount(1, $this->benevole->clienteles);
    }

    /** @test */
    public function it_can_add_clientele()
    {
        $this->benevole->addClientele(1);
        $this->assertCount(1, $this->benevole->clienteles);
    }

    /** @test */
    public function it_cannot_add_the_same_clientele_twice()
    {
        $this->benevole->addClientele(1);
        $this->benevole->addClientele(1);
        $this->assertCount(1, $this->benevole->clienteles);
    }

    /** @test */
    public function it_can_add_multiple_clienteles_at_the_same_time()
    {
        $this->benevole->addClientele(
            [
                1,
                2,
            ]
        );
        $this->assertCount(2, $this->benevole->clienteles);
    }

    /** @test */
    public function it_can_have_interets()
    {
        DB::table('benevole_interet')->insert([
            'benevole_id' => $this->benevole->id,
            'interet_id' => 1,
        ]);

        $this->assertCount(1, $this->benevole->interets);
    }

    /** @test */
    public function it_can_add_interet()
    {
        $this->benevole->addInteret(1, ['priority' => 1]);
        $this->assertCount(1, $this->benevole->interets);
    }

    /** @test */
    public function it_cannot_add_the_same_interet_twice()
    {
        $this->benevole->addInteret(1, ['priority' => 1]);
        $this->benevole->addInteret(1, ['priority' => 2]);
        $this->assertCount(1, $this->benevole->interets);
    }

    /** @test */
    public function it_can_add_multiple_interets_at_the_same_time()
    {
        $this->benevole->addInteret(
            [
                1 => ['priority' => 1],
                2 => ['priority' => 1],
            ]
        );
        $this->assertCount(2, $this->benevole->interets);
    }

    /** @test */
    public function it_can_have_competences()
    {
        DB::table('benevole_competence')->insert([
            'benevole_id' => $this->benevole->id,
            'competence_id' => 1,
        ]);

        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_can_add_competence()
    {
        $this->benevole->addCompetence(1, ['priority' => 2]);
        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_cannot_add_the_same_competence_twice()
    {
        $this->benevole->addCompetence(1, ['priority' => 2]);
        $this->benevole->addCompetence(1, ['priority' => 4]);
        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_can_add_multiple_competences_at_the_same_time()
    {
        $this->benevole->addCompetence(
            [
                1 => ['priority' => 1],
                2 => ['priority' => 2],
            ]
        );
        $this->assertCount(2, $this->benevole->competences);
    }
}