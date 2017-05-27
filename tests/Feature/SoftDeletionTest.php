<?php

namespace Tests\Feature;

use App\Beneficiaire;
use App\Benevole;
use App\Organisme;
use App\Service;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SoftDeletionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function non_admin_cannot_delete_models()
    {
        $this->withExceptionHandling()->signIn();

        $items = [
            'benevoles' => create(Benevole::class),
            'users' => create('App\User'),
            'beneficiaires' => create(Beneficiaire::class),
            'services' => create('App\Service'),
            'organismes' => create(Organisme::class),
        ];

        foreach ($items as $item => $model) {
            $this->delete($item.'/'.$model->id)
                ->assertStatus(403);

            $this->assertFalse($model->trashed());
        }
    }

    /** @test */
    function an_administrator_should_be_able_to_soft_delete_some_models()
    {
        $admin = create('App\User', ['isAdmin' => true]);
        $this->withExceptionHandling()->signIn($admin);
        $this->assertTrue(auth()->user()->isAdmin);

        $items = [
            'benevoles' => create(Benevole::class),
            'users' => create(User::class),
            'beneficiaires' => create(Beneficiaire::class),
            'organismes' => create(Organisme::class),
        ];

        foreach ($items as $item => $model) {
            $this->delete($item.'/'.$model->id)
                ->assertStatus(302);
            $this->assertTrue($model->fresh()->trashed());
        }
    }

    /** @test */
    function an_administrator_should_be_able_to_restore_some_models()
    {
        $admin = create('App\User', ['isAdmin' => true]);
        $this->withExceptionHandling()->signIn($admin);
        $this->assertTrue(auth()->user()->isAdmin);

        $items = [
            'benevoles' => create(Benevole::class),
            'users' => create(User::class),
            'beneficiaires' => create(Beneficiaire::class),
            'organismes' => create(Organisme::class),
        ];

        foreach ($items as $item => $model) {
            $id = $model->id;
            $class = get_class($model);
            $model->delete();
            $this->post($item.'/'.$id.'/restore')
                ->assertStatus(302);
            $this->assertFalse($class::find($id)->trashed());
        }
    }
}
