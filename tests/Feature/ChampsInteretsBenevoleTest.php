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
}
