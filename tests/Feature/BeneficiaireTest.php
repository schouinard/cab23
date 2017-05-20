<?php

namespace Tests\Feature;

use App\Adress;
use App\Beneficiaire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BeneficiaireTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  Beneficiaire */
    protected $beneficiaire;

    public function setUp()
    {
        parent::setUp();
        $this->beneficiaire = create(Beneficiaire::class);
        $this->signIn();
    }

    /** @test */
    function a_user_can_see_beneficiaires()
    {
        $this->get('/beneficiaires')->assertSee(webformat($this->beneficiaire->nom));
    }

    /** @test */
    function a_user_can_see_a_specific_beneficiaire()
    {
        $this->withExceptionHandling();
        $this->get($this->beneficiaire->path())->assertSee(webformat($this->beneficiaire->nom));
    }

    /** @test */
    function a_user_can_see_services_given_to_beneficiaire()
    {
        $service = create('App\Service', ['serviceable_id' => $this->beneficiaire->id]);

        $this->get($this->beneficiaire->path())->assertSee($service->rendu_le);
    }
}
