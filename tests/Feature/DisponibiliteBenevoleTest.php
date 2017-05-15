<?php

namespace Tests\Feature;

use App\Benevole;
use App\Day;
use App\Disponibilite;
use App\Moment;
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
        $this->assertInstanceOf(Day::class, $this->benevole->disponibilites->first()->day);
    }

    /** @test */
    function a_disponibilite_has_a_moment()
    {
        $this->assertInstanceOf(Moment::class, $this->benevole->disponibilites->first()->moment);
    }

    /** @test */
    function a_benevole_can_sync_disponibilites()
    {
        $this->benevole->addDisponibilites([
            1 => [
                'day_id' => 1,
                'moment_id' => 1,
            ],
            2 => [
                'day_id' => 1,
                'moment_id' => 2,
            ],
        ]);

        $this->assertCount(2, $this->benevole->disponibilites);
    }

    /** @test */
    function a_benevole_can_add_an_array_of_days_as_disponibilites()
    {
        $this->benevole->addDisponibilites(
            [1 => [1, 2], 2 => [1]]
        );
        $this->assertCount(3, $this->benevole->disponibilites);
    }
}
