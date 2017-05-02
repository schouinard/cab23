<?php

namespace Tests\Unit;

use App\Activity;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->signIn(User::find(1));
    }

    /** @test */
    function it_records_activity_when_a_benevole_is_created()
    {
        $benevole = create('App\Benevole');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_benevole',
            'user_id' => auth()->id(),
            'subject_id' => $benevole->id,
            'subject_type' => 'App\Benevole',
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $benevole->id);
    }

    /** @test */
    function it_records_activity_when_a_beneficiaire_is_created()
    {
        $beneficiaire = create('App\Beneficiaire');

        $this->assertEquals(1, Activity::count());
    }

    /** @test */
    function it_records_activity_when_a_service_is_created()
    {
        create('App\Service');

        //the factory creates a benevole, a beneficiaire and a service.
        $this->assertEquals(3, Activity::count());
    }
}
