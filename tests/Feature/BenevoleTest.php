<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Benevole;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BenevoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @var \App\Benevole **/
    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->benevole = create(Benevole::class);
    }

    /** @test */
    function a_user_can_see_benevoles()
    {
        $this->get('/benevoles')->assertSee(webformat($this->benevole->nom));
    }

    /** @test */
    function a_user_can_see_a_specific_benevole()
    {
        $this->get($this->benevole->path())->assertSee(webformat($this->benevole->nom));
    }

    /** @test */
    function a_user_can_see_services_associated_with_a_benevole()
    {
        $service = create('App\Service', ['benevole_id' => $this->benevole->id]);

        $this->get($this->benevole->path())->assertSeeText($service->rendu_le);
    }

    /** @test */
    function a_user_can_see_adress_on_listing_page()
    {
        $this->get('/benevoles')->assertSee(webformat($this->benevole->adress->adresse));
    }
}
