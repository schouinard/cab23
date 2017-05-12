<?php

namespace Tests\Feature;

use App\Benevole;
use App\Clientele;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChampsInteretsBenevoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  Benevole */
    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->benevole = create(Benevole::class);
    }

    /** @test */
    function un_benevole_can_have_multiple_clienteles()
    {
        $this->benevole->clienteles()->sync([1, 2]);
        $this->assertCount(2, $this->benevole->clienteles);
    }

    /** @test */
    function une_fiche_benevole_affiche_les_clienteles_associees()
    {
        $clientele = Clientele::find(1);

        $this->get($this->benevole->path())
            ->assertDontSee($clientele->nom);

        $this->benevole->clienteles()->sync([$clientele->id]);

        $this->get($this->benevole->path())
            ->assertSee(webformat($clientele->nom));
    }
}
