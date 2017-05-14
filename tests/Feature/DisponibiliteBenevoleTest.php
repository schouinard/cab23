<?php

namespace Tests\Feature;

use App\Benevole;
use App\Day;
use App\Disponibilite;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DisponibiliteBenevoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  \App\Benevole */
    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->benevole = create(Benevole::class);
        create(Disponibilite::class, ['benevole_id' => $this->benevole->id]);
    }

    /** @test */
    function it_can_have_disponibilites()
    {
        $this->assertInstanceOf(Disponibilite::class, $this->benevole->disponibilites->first());
    }

    /** @test */
    function a_disponibilite_has_a_day_of_the_week()
    {
        $this->assertInstanceOf(Day::class, $this->benevole->disponibilites->first()->dayOfTheWeek);
    }
}
