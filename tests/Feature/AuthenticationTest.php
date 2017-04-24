<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_anonymous_user_should_see_the_login_page_when_trying_to_access_the_admin_panel()
    {
        $this->expectException(Auth\AuthenticationException::class);
        $this->get('/');
    }
}
