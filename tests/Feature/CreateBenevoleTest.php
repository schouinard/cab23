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
        $this->actingAs(factory('App\User')->create());
        $benevole = factory('App\Benevole')->make();

        $this->post('/benevoles', $benevole->toArray());

        $this->get($benevole->path())
            ->assertSee($benevole->nom)
            ->assertSee($benevole->prenom);
    }
}
