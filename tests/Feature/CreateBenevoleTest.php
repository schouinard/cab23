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
        $benevole = make('App\Benevole');

        $this->post('/benevoles', $benevole->toArray());

        $this->get($benevole->path())
            ->assertSee($benevole->nom)
            ->assertSee($benevole->prenom);
    }
}
