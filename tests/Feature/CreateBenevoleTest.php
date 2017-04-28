<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateBenevoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_authenticated_user_can_create_new_benevole()
    {
        $this->signIn();
        $benevole = raw('App\Benevole');

        $this->post('/benevoles', $benevole);

        $this->get('/benevoles')->assertSee($benevole['nom'])->assertSee($benevole['prenom']);
    }

    /** @test */
    function it_must_have_a_prenom()
    {
        $this->publishBenevole(['prenom' => null])->assertSessionHasErrors('prenom');
    }

    /** @test */
    function it_must_have_a_nom()
    {
        $this->publishBenevole(['nom' => null])->assertSessionHasErrors('nom');
    }

    /** @test */
    function it_must_have_a_adresse()
    {
        $this->publishBenevole(['adresse' => null])->assertSessionHasErrors('adresse');
    }

    /** @test */
    function it_must_have_a_ville()
    {
        $this->publishBenevole(['ville' => null])->assertSessionHasErrors('ville');
    }

    /** @test */
    function it_must_have_a_province()
    {
        $this->publishBenevole(['province' => null])->assertSessionHasErrors('province');
    }

    /** @test */
    function it_must_have_a_cp()
    {
        $this->publishBenevole(['code_postal' => null])->assertSessionHasErrors('code_postal');
    }

    public function publishBenevole($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $benevole = make('App\Benevole', $overrides);

        return $this->post('/benevoles', $benevole->toArray());
    }

    /** @test */
    function it_shows_errors_after_validation()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/benevoles/create')->assertDontSee('Veuillez valider');
        $response = $this->publishBenevole(['code_postal' => null]);
        $response->assertRedirect('/benevoles/create');

        $this->followRedirects($response)->assertSee('Veuillez valider');
    }
}
