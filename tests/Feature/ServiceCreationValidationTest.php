<?php

namespace Tests\Feature;

use App\Beneficiaire;
use App\Benevole;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceCreationValidationTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  Beneficiaire */
    protected $beneficiaire;

    /** @var  Benevole */
    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->beneficiaire = create(Beneficiaire::class);
        $this->benevole = create(Benevole::class);
    }

    public function publishService($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $overrides = array_merge($overrides, [
            'serviceable_id' => $this->beneficiaire->id,
            'benevole_id' => $this->benevole->id,
        ]);
        $service = make('App\Service', $overrides);

        return $this->post('/services', $service->toArray());
    }

    /** @test */
    function it_requires_a_valid_competence()
    {
        $this->publishService(['competence_id' => null])->assertSessionHasErrors('competence_id');

        $this->publishService(['competence_id' => 999])->assertSessionHasErrors('competence_id');
    }

    /** @test */
    function it_does_not_show_error_messages_on_first_load()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/services')->assertDontSee('error-content');
    }

    /** @test */
    function it_shows_error_on_invalid_competence()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/services')->assertDontSee('error-content');
        $response = $this->publishService(['competence_id' => null]);
        $response->assertRedirect('/services');

        $this->followRedirects($response)->assertSee('error-content');
    }
}
