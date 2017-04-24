<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateBeneficiaireTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function an_authenticated_user_can_create_new_beneficiaire()
    {
        $this->actingAs(factory('App\User')->create());
        $beneficiaire = factory('App\Beneficiaire')->make();

        $this->post('/beneficiaires', $beneficiaire->toArray());

        $this->get($beneficiaire->path())
            ->assertSee($beneficiaire->nom)
            ->assertSee($beneficiaire->prenom);
    }
}
