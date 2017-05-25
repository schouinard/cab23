<?php

namespace Tests\Unit;

use App\Beneficiaire;
use App\Benevole;
use App\Competence;
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
        $this->service = create(Service::class);
    }

    /** @test */
    function it_has_a_benevole()
    {
        $this->assertInstanceOf(Benevole::class, $this->service->benevole);
    }

    /** @test */
    function it_has_a_serviceable()
    {
        $this->assertNotNull($this->service->serviceable_id);
    }

    /** @test */
    function it_should_return_50_latest()
    {
        factory(Service::class, 100)->create();
        $this->assertCount(50, Service::latest());
    }

    /** @test */
    function it_has_a_servicetype()
    {
        $this->assertInstanceOf(Competence::class, $this->service->competence);
    }
}

