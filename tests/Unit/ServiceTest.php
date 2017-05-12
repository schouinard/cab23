<?php

namespace Tests\Unit;

use App\Beneficiaire;
use App\Benevole;
use Tests\TestCase;
use App\Service;
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
        $this->assertInstanceOf(Benevole::class, $this->service->benevole);
    }

    /** @test */
    function it_has_a_beneficiaire()
    {
        $this->assertInstanceOf(Beneficiaire::class, $this->service->beneficiaire);
    }

    /** @test */
    function it_should_return_50_latest()
    {
        factory('App\Service', 100)->create();
        $this->assertCount(50, Service::latest());
    }

    /** @test */
    function it_has_a_servicetype()
    {
        $this->assertInstanceOf('App\ServiceType', $this->service->type);
    }
}

