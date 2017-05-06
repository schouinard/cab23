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
        $this->get('/beneficiaires')->assertSee(htmlentities($this->beneficiaire->nom, ENT_QUOTES));
    }

    /** @test */
    function a_user_can_see_a_specific_beneficiaire()
    {
        $this->get($this->beneficiaire->path())->assertSee(htmlentities($this->beneficiaire->nom, ENT_QUOTES));
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

    public function publishService($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $service = make('App\Service', $overrides);

        return $this->post($this->beneficiaire->path().'/services', $service->toArray());
    }

    /** @test */
    function a_benevole_is_required_to_add_a_service()
    {
        $this->publishService(['benevole_id' => null])->assertSessionHasErrors('benevole_id');
    }

    /** @test */
    function a_service_type_is_required_to_add_a_service()
    {
        $this->publishService(['service_type_id' => null])->assertSessionHasErrors('service_type_id');
    }

    /** @test */
    function a_valid_date_for_rendu_le_is_required_to_add_a_service()
    {
        $this->publishService(['rendu_le' => null])->assertSessionHasErrors('rendu_le');
        $this->publishService(['rendu_le' => '1231231231231'])->assertSessionHasErrors('rendu_le');
    }

    /** @test */
    function it_shows_error_on_invalid_service()
    {
        $this->withExceptionHandling()->signIn();
        $this->get($this->beneficiaire->path())->assertDontSee('error-content');
        $response = $this->publishService(['service_type_id' => null]);
        $response->assertRedirect($this->beneficiaire->path());

        $this->followRedirects($response)->assertSee('error-content');
    }

    /** @test */
    function it_can_have_a_secteur()
    {
        $this->assertInstanceOf(\App\Secteur::class, $this->beneficiaire->secteur);
    }
}
