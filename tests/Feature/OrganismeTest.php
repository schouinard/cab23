<?php

namespace Tests\Feature;

use App\Adress;
use App\Organisme;
use App\OrganismeType;
use App\Person;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrganismeTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  Organisme */
    protected $organisme;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->organisme = create(Organisme::class);
    }



    /** @test */
    function it_can_add_an_adress()
    {
        $adress = raw(Adress::class);

        $this->organisme->addAdress($adress);

        $this->assertInstanceOf(Adress::class, $this->organisme->adress);
        $this->assertNotNull($this->organisme->adress);
    }

    /** @test */
    function it_can_update_an_adress()
    {
        $adress = raw(Adress::class, ['adresse' => 'adresse1']);
        $this->organisme->addAdress($adress);

        $adress = raw(Adress::class, ['adresse' => 'adresse2']);
        $this->organisme->updateAdress($adress);

        $this->assertEquals('adresse2', $this->organisme->fresh()->adress->adresse);
    }

    /** @test */
    function it_can_add_people()
    {
        $people = raw(Person::class, [
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw
            (Adress::class),
        ], 3);

        $this->organisme->addPeople($people);

        $this->assertCount(3, $this->organisme->people);
        $this->assertInstanceOf(Person::class, $this->organisme->people->first());
    }

    /** @test */
    function a_user_can_see_a_list_of_organismes()
    {
        $this->get('/organismes')->assertSee($this->organisme->nom);
    }

    /** @test */
    function it_can_add_regroupements()
    {
        $this->organisme->addRegroupements([1,2]);

        $this->assertCount(2, $this->organisme->regroupements);
    }

}
