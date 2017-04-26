<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServicesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_should_display_services()
    {
        $this->withExceptionHandling()->signIn();
        $this->get('/services')->assertSee('Services rendus');
    }
}
