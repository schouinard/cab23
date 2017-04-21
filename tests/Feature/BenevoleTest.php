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
        $this->benevole = factory('App\Benevole')->create();
    }

    /** @test */
    function a_user_can_see_benevoles()
    {
        $this->get('/benevoles')->assertSee($this->benevole->nom);
    }

    /** @test */
    function a_user_can_see_a_specific_benevole()
    {
        $this->get($this->benevole->path())->assertSee($this->benevole->nom);
    }

    /** @test */
    function a_user_can_see_services_associated_with_a_benevole()
    {
        $service = factory('App\Service')->create(['benevole_id' => $this->benevole->id]);

        $this->get($this->benevole->path())->assertSee($service->rendu_le);
    }
}