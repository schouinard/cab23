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
        $this->signIn();
        $beneficiaire = raw('App\Beneficiaire');

        $this->post('/beneficiaires', $beneficiaire);

        $this->get('/beneficiaires')
            ->assertSee($beneficiaire['nom'])
            ->assertSee($beneficiaire['prenom']);
    }

    /** @test */
    function it_must_have_a_prenom()
    {
        $this->publishBeneficiaire(['prenom' => null])
            ->assertSessionHasErrors('prenom');
    }

    /** @test */
    function it_must_have_a_nom()
    {
        $this->publishBeneficiaire(['nom' => null])
            ->assertSessionHasErrors('nom');
    }

    /** @test */
    function it_must_have_a_adresse()
    {
        $this->publishBeneficiaire(['adresse' => null])
            ->assertSessionHasErrors('adresse');
    }

    /** @test */
    function it_must_have_a_ville()
    {
        $this->publishBeneficiaire(['ville' => null])
            ->assertSessionHasErrors('ville');
    }

    /** @test */
    function it_must_have_a_province()
    {
        $this->publishBeneficiaire(['province' => null])
            ->assertSessionHasErrors('province');
    }

    /** @test */
    function it_must_have_a_cp()
    {
        $this->publishBeneficiaire(['code_postal' => null])
            ->assertSessionHasErrors('code_postal');
    }

    public function publishBeneficiaire($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $beneficiaire = make('App\Beneficiaire', $overrides);

        return $this->post('/beneficiaires', $beneficiaire->toArray());
    }
}
