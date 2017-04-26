<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $service;

    function setUp()
    {
        parent::setUp();
        $this->service = create('App\Service');
    }

    /** @test */
    function it_has_a_benevole()
    {
        $this->assertInstanceOf('App\Benevole', $this->service->benevole);
    }

    /** @test */
    function it_has_a_beneficiaire()
    {
        $this->assertInstanceOf('App\Beneficiaire', $this->service->beneficiaire);
    }
}

