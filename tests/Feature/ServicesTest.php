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

    /** @test */
    function a_user_can_filter_by_service_type()
    {
        $this->withExceptionHandling()->signIn();

        $service = create('App\Service', ['service_type_id' => 1, 'rendu_le' => '1979-01-01']);
        $otherService = create('App\Service', ['service_type_id' => 2, 'rendu_le' => '2010-01-01']);

        $this->get('services?type=1')
            ->assertSee($service->rendu_le)
            ->assertDontSee($otherService->rendu_le);
    }
}
