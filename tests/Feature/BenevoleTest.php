<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Benevole;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BenevoleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->benevole = create('App\Benevole');
    }

    /** @test */
    function a_user_can_see_benevoles()
    {
        $this->get('/benevoles')->assertSee(htmlentities($this->benevole->nom, ENT_QUOTES));
    }

    /** @test */
    function a_user_can_see_a_specific_benevole()
    {
        $this->get($this->benevole->path())->assertSee(htmlentities($this->benevole->nom, ENT_QUOTES));
    }

    /** @test */
    function a_user_can_see_services_associated_with_a_benevole()
    {
        $service = create('App\Service', ['benevole_id' => $this->benevole->id]);

        $this->get($this->benevole->path())->assertSeeText($service->rendu_le);
    }

    /** @test */
    function a_user_can_add_a_service()
    {
        $service = make('App\Service', ['benevole_id' => $this->benevole->id]);
        $this->post($this->benevole->path().'/services', $service->toArray());

        //the service should be visible on the page
        $this->get($this->benevole->path())->assertSee($service->rendu_le);
    }
}
