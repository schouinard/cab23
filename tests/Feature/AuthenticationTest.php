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

    /** @test */
    function an_anonymous_user_cannot_register()
    {
        $this->withExceptionHandling()->get('/login')->assertDontSee('register');
    }

    /** @test */
    function the_register_route_is_disabled()
    {
        $this->expectException('ReflectionException');
        $this->get('/register');
    }

    /** @test */
    function the_login_homepage_is_the_benevole_list()
    {
        $this->withExceptionHandling()->signIn()->get('/')->assertRedirect('/benevoles');
    }
}
