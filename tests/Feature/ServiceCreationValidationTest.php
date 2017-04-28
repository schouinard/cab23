<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceCreationValidationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->beneficiaire = create('App\Beneficiaire');
        $this->benevole = create('App\Benevole');
    }

    public function publishService($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $overrides = array_merge($overrides, [
            'beneficiaire_id' => $this->beneficiaire->id,
            'benevole_id' => $this->benevole->id,
        ]);
        $service = make('App\Service', $overrides);

        return $this->post($this->beneficiaire->path().'/services', $service->toArray());
    }

    /** @test */
    function it_requires_a_valid_service_type()
    {
        $this->publishService(['service_type_id' => null])->assertSessionHasErrors('service_type_id');

        $this->publishService(['service_type_id' => 999])->assertSessionHasErrors('service_type_id');
    }

    /** @test */
    function it_does_not_show_error_messages_on_first_load()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/services')->assertDontSee('error-content');
    }

    /** @test */
    function it_shows_error_on_invalid_service_type()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/services')->assertDontSee('error-content');
        $response = $this->publishService(['service_type_id' => null]);
        $response->assertRedirect('/services');

        $this->followRedirects($response)->assertSee('error-content');
    }
}
