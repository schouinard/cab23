<?php

namespace Tests\Unit;

use App\Beneficiaire;
use App\Competence;
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
            'competence_id' => 1,
            'don' => 10,
            'serviceable_id' => create(Beneficiaire::class)->id,
            'serviceable_type' => Beneficiaire::class,
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
        $this->benevole->addClienteles(1);
        $this->assertCount(1, $this->benevole->clienteles);
    }

    /** @test */
    public function it_cannot_add_the_same_clientele_twice()
    {
        $this->benevole->addClienteles(1);
        $this->benevole->addClienteles(1);
        $this->assertCount(1, $this->benevole->clienteles);
    }

    /** @test */
    public function it_can_add_multiple_clienteles_at_the_same_time()
    {
        $this->benevole->addClienteles(
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
        DB::table('benevole_competence')->insert([
            'benevole_id' => $this->benevole->id,
            'competence_id' => Competence::where('type', 'interet')->get()->first()->id,
        ]);

        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_can_add_interet()
    {
        $this->benevole->addCompetence(Competence::where('type', 'interet')->get()->first()->id, ['priority' => 1]);
        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_cannot_add_the_same_interet_twice()
    {
        $this->benevole->addCompetence(Competence::where('type', 'interet')->get()->first()->id, ['priority' => 1]);
        $this->benevole->addCompetence(Competence::where('type', 'interet')->get()->first()->id, ['priority' => 2]);
        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_can_add_multiple_interets_at_the_same_time()
    {
        $this->benevole->addCompetence(
            [
                Competence::where('type', 'interet')->get()->first()->id => ['priority' => 1],
                Competence::where('type', 'interet')->take(1)->skip(1)->first()->id => ['priority' => 1],
            ]
        );
        $this->assertCount(2, $this->benevole->competences);
    }

    /** @test */
    public function it_can_have_competences()
    {
        DB::table('benevole_competence')->insert([
            'benevole_id' => $this->benevole->id,
            'competence_id' => Competence::where('type', 'competence')->get()->first()->id,
        ]);

        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_can_add_competence()
    {
        $this->benevole->addCompetence(Competence::where('type', 'competence')->get()->first()->id, ['priority' => 2]);
        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_cannot_add_the_same_competence_twice()
    {
        $this->benevole->addCompetence(Competence::where('type', 'competence')->get()->first()->id, ['priority' => 2]);
        $this->benevole->addCompetence(Competence::where('type', 'competence')->get()->first()->id, ['priority' => 4]);
        $this->assertCount(1, $this->benevole->competences);
    }

    /** @test */
    public function it_can_add_multiple_competences_at_the_same_time()
    {
        $this->benevole->addCompetence(
            [
                Competence::where('type', 'competence')->get()->first()->id => ['priority' => 1],
                Competence::where('type', 'competence')->take(1)->skip(1)->first()->id => ['priority' => 2],
            ]
        );
        $this->assertCount(2, $this->benevole->competences);
    }

    /** @test */
    public function it_can_have_indisponibilites()
    {
        DB::table('indisponibilites')->insert([
            'benevole_id' => $this->benevole->id,
            'from' => Carbon::create(2017, 3, 10),
            'to' => Carbon::create(2017, 3, 12),
        ]);

        DB::table('indisponibilites')->insert([
            'benevole_id' => $this->benevole->id,
            'from' => Carbon::create(2017, 4, 10),
            'to' => Carbon::create(2017, 4, 12),
        ]);

        $this->assertCount(2, $this->benevole->indisponibilites);
    }

    /** @test */
    public function it_can_add_indisponibilites()
    {
        $this->benevole->addIndisponibilite(Carbon::create(2017, 4, 10),
            Carbon::create(2017, 4, 12));

        $this->assertCount(1, $this->benevole->indisponibilites);
    }

    /** @test */
    public function it_can_remove_indisponibilite()
    {
        $this->benevole->addIndisponibilite(Carbon::create(2017, 4, 10),
            Carbon::create(2017, 4, 12));

        $this->benevole->removeIndisponibilite($this->benevole->indisponibilites->first()->id);

        $this->assertCount(0, $this->benevole->fresh()->indisponibilites);
    }
}