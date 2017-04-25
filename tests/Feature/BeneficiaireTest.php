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
        $this->beneficiaire = create('App\Beneficiaire');
        $this->signIn();
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
        $service = create('App\Service', ['beneficiaire_id' => $this->beneficiaire->id]);

        $this->get($this->beneficiaire->path())->assertSee($service->rendu_le);
    }

    /** @test */
    function a_user_can_add_a_service()
    {
        $service = make('App\Service', ['beneficiaire_id' => $this->beneficiaire->id]);
        $this->post($this->beneficiaire->path().'/services', $service->toArray());

        //the service should be visible on the page
        $this->get($this->beneficiaire->path())->assertSee($service->rendu_le);
    }

    ///** @test */
    //function it_requires_a_valid_service_type()
    //{
    //    $this->publishService(['service_type_id' => null])
    //        ->assertSessionHasErrors('service_type_id');
    //
    //    $this->publishService(['service_type_id' => 999])
    //        ->assertSessionHasErrors('service_type_id');
    //}
    //
    //public function publishService($overrides = [])
    //{
    //    $this->withExceptionHandling()->signIn();
    //
    //    $overrides = array_merge($overrides, ['beneficiaire_id' => $this->beneficiaire->id]);
    //    $service = make('App\Service', $overrides);
    //
    //    return $this->post($this->beneficiaire->path().'/services', $service->toArray());
    //}
}
