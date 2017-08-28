<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersManagementTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function only_administrators_can_view_users()
    {
        // Given we have a user without an administrator role
        $this->signIn()->withExceptionHandling();
        // we cant see the option in the menu
        $this->get('/')
            ->assertDontSee('Utilisateurs');
        // we cant access the users routes
        $this->get('/users')
            ->assertStatus(403);
    }

    /** @test */
    function an_admin_can_create_a_user()
    {
        $this->signIn(User::find(1))->withExceptionHandling();

        $user = raw(User::class);
        $user['confirm_password'] = $user['password'];

        $this->post('/users', $user);

        $this->get('/users')->assertSee($user['email']);

    }

    /** @test */
    function an_admin_can_create_an_admin_user()
    {
        $this->signIn(User::find(1))->withExceptionHandling();

        $user = raw(User::class);
        $user['confirm_password'] = $user['password'];
        $user['isAdmin'] = true;

        $this->post('/users', $user);

        $this->get('/users')->assertSee($user['email']);

    }
}
