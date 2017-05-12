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

    /** @var \App\Benevole **/
    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->benevole = create(Benevole::class);
    }

    /** @test */
    function a_user_can_see_benevoles()
    {
        $this->get('/benevoles')->assertSee(webformat($this->benevole->nom));
    }

    /** @test */
    function a_user_can_see_a_specific_benevole()
    {
        $this->get($this->benevole->path())->assertSee(webformat($this->benevole->nom));
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

    public function publishService($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $service = make('App\Service', $overrides);

        return $this->post($this->benevole->path().'/services', $service->toArray());
    }

    /** @test */
    function a_beneficiaire_is_required_to_add_a_service()
    {
        $this->publishService(['beneficiaire_id' => null])->assertSessionHasErrors('beneficiaire_id');
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
        $this->get($this->benevole->path())->assertDontSee('error-content');
        $response = $this->publishService(['service_type_id' => null]);
        $response->assertRedirect($this->benevole->path());

        $this->followRedirects($response)->assertSee('error-content');
    }

    /** @test */
    function it_can_have_a_secteur()
    {
        $this->assertInstanceOf(\App\Secteur::class, $this->benevole->secteur);
    }
}
