<?php

namespace Tests\Feature;

use App\Adress;
use App\Beneficiaire;
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
        $beneficiaire = raw(Beneficiaire::class);
        $beneficiaire['adress'] = raw(Adress::class);


        $this->post('/beneficiaires', $beneficiaire);

        $this->get('/beneficiaires')
            ->assertSee(webformat($beneficiaire['nom']))
            ->assertSee(webformat($beneficiaire['prenom']));
    }

    /** @test */
    function it_must_have_a_prenom()
    {
       $test = $this->publishBeneficiaire(['prenom' => null])->assertSessionHasErrors('prenom');
    }

    /** @test */
    function it_must_have_a_nom()
    {
        $this->publishBeneficiaire(['nom' => null])->assertSessionHasErrors('nom');
    }

    /** @test */
    function it_must_have_a_adresse()
    {
        $this->publishBeneficiaire([], ['adress.adresse'])->assertSessionHasErrors('adress.adresse');
    }

    /** @test */
    function it_must_have_a_ville()
    {
        $this->publishBeneficiaire([], ['adress.ville'])->assertSessionHasErrors('adress.ville');
    }

    /** @test */
    function it_must_have_a_province()
    {
        $this->publishBeneficiaire([], ['adress.province'])->assertSessionHasErrors('adress.province');
    }

    /** @test */
    function it_must_have_a_cp()
    {
        $this->publishBeneficiaire([], ['adress.code_postal'])->assertSessionHasErrors('adress.code_postal');
    }

    public function publishBeneficiaire($overrides = [], $except = [])
    {
        $this->withExceptionHandling()->signIn();

        $beneficiaire = make(Beneficiaire::class, $overrides);

        return $this->post('/beneficiaires', array_except($beneficiaire->toArray(), $except));
    }

    /** @test */
    function it_shows_errors_after_validation()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/beneficiaires/create')->assertDontSee('Veuillez valider');
        $response = $this->publishBeneficiaire(['prenom' => null]);
        $response->assertRedirect('/beneficiaires/create');

        $this->followRedirects($response)->assertSee('Veuillez valider');
    }
}
