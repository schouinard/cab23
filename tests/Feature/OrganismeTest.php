<?php

namespace Tests\Feature;

use App\Adress;
use App\Organisme;
use App\OrganismeSecteur;
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
    function it_has_a_name()
    {
        $organisme = create(Organisme::class, ['nom' => 'St-Hubert']);
        $this->assertEquals('St-Hubert', $organisme->nom);
    }

    /** @test */
    function it_can_have_people()
    {
        $person = create(Person::class, ['contactable_id' => $this->organisme->id, 'contactable_type' =>
            Organisme::class]);
        $person2 = create(Person::class, ['contactable_id' => $this->organisme->id, 'contactable_type' =>
            Organisme::class]);

        $this->assertCount(2, $this->organisme->people);
        $this->assertInstanceOf(Person::class, $this->organisme->people->first());
    }

    /** @test */
    function it_has_an_adress()
    {
        $adress = create(Adress::class);
        $this->organisme->adress_id = $adress->id;

        $this->assertInstanceOf(Adress::class, $this->organisme->adress);
        $this->assertEquals($adress->adresse, $this->organisme->adress->adresse);
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
    function it_has_a_type()
    {
        $this->assertInstanceOf(OrganismeType::class, $this->organisme->type);
    }

    /** @test */
    function it_has_a_secteur()
    {
        $this->assertInstanceOf(OrganismeSecteur::class, $this->organisme->secteur);
    }

    /** @test */
    function a_user_can_see_a_list_of_organismes()
    {
        $this->get('/organismes')->assertSee($this->organisme->nom);
    }
}
