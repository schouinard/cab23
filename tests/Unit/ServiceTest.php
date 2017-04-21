<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function it_has_a_benevole()
    {
        $service = factory('App\Service')->create();

        $this->assertInstanceOf('App\Benevole', $service->benevole);
    }
}
