<?php

namespace Tests\Feature;

use App\Clientele;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChampsInteretsBenevoleTest extends TestCase
{
    use DatabaseMigrations;

    protected $benevole;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->benevole = create('App\Benevole');
    }

    /** @test */
    function un_benevole_can_have_multiple_clienteles()
    {
        $this->benevole->clienteles()->sync([1,2]);
        $this->assertCount(2, $this->benevole->clienteles);
    }
}
