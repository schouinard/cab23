<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeneficiaireTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->beneficiaire = factory('App\Beneficiaire')->create();
        $this->be(factory('App\User')->create());
    }

    /** @test */
    function a_user_can_see_beneficiaires()
    {
        $this->get('/beneficiaires')->assertSee($this->beneficiaire->nom);
    }

    /** @test */
    function a_user_can_see_a_specific_beneficiaire()
    {
        $this->get($this->beneficiaire->path())->assertSee($this->beneficiaire->nom);
    }

    /** @test */
    function a_user_can_see_services_given_to_beneficiaire()
    {
        $service = factory('App\Service')->create(['beneficiaire_id' => $this->beneficiaire->id]);

        $this->get($this->beneficiaire->path())->assertSee($service->rendu_le);
    }

    /** @test */
    function a_user_can_add_a_service()
    {
        $service = factory('App\Service')->make(['beneficiaire_id' => $this->beneficiaire->id]);
        $this->post($this->beneficiaire->path().'/services', $service->toArray());

        //the service should be visible on the page
        $this->get($this->beneficiaire->path())->assertSee($service->rendu_le);
    }
}
