<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = create('App\User');

        $this->signIn($this->user);
    }

    /** @test */
    function a_user_has_a_profile()
    {
        $this->get('users/'. $this->user->id)
            ->assertSee($this->user->name);
    }
}
