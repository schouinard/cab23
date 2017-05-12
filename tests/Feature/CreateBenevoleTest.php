<?php

namespace Tests\Feature;

use App\Adress;
use App\Benevole;
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
        $benevole = raw(Benevole::class);
        $benevole['adress'] = raw(Adress::class);

        $this->post('/benevoles', $benevole);

        $this->get('/benevoles')
            ->assertSee(webformat($benevole['nom']))
            ->assertSee(webformat($benevole['prenom']));
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
        $this->publishBenevole([],['adress.adresse'])->assertSessionHasErrors('adress.adresse');
    }

    /** @test */
    function it_must_have_a_ville()
    {
        $this->publishBenevole([],['adress.ville'])->assertSessionHasErrors('adress.ville');
    }

    /** @test */
    function it_must_have_a_province()
    {
        $this->publishBenevole([],['adress.province'])->assertSessionHasErrors('adress.province');
    }

    /** @test */
    function it_must_have_a_cp()
    {
        $this->publishBenevole([],['adress.code_postal'])->assertSessionHasErrors('adress.code_postal');
    }

    public function publishBenevole($overrides = [], $except = [])
    {
        $this->withExceptionHandling()->signIn();

        $benevole = make(Benevole::class, $overrides);

        return $this->post('/benevoles', array_except($benevole->toArray(), $except));
    }

    /** @test */
    function it_shows_errors_after_validation()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/benevoles/create')->assertDontSee('Veuillez valider');
        $response = $this->publishBenevole(['prenom' => null]);
        $response->assertRedirect('/benevoles/create');

        $this->followRedirects($response)->assertSee('Veuillez valider');
    }
}
