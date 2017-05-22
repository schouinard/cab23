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

    function it_has_a_display_name()
    {
        $organisme = create(Organisme::class, ['nom' => 'St-Hubert']);
        $this->assertEquals('St-Hubert', $organisme->displayName);
    }

    /** @test */
    function it_can_have_a_president()
    {
        $person = create(Person::class, [
            'contactable_id' => $this->organisme->id,
            'contactable_type' =>
                Organisme::class,
            'lien' => 'Président',
        ]);

        $this->assertEquals($person->nom, $this->organisme->president->nom);
        $this->assertInstanceOf(Person::class, $this->organisme->president);
    }

    /** @test */
    function it_can_have_a_employe()
    {
        $person = create(Person::class, [
            'contactable_id' => $this->organisme->id,
            'contactable_type' =>
                Organisme::class,
            'lien' => 'Employé',
        ]);

        $this->assertEquals($person->nom, $this->organisme->employe->nom);
        $this->assertInstanceOf(Person::class, $this->organisme->employe);
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
    function it_can_update_an_adress()
    {
        $adress = raw(Adress::class, ['adresse' => 'adresse1']);
        $this->organisme->addAdress($adress);

        $adress = raw(Adress::class, ['adresse' => 'adresse2']);
        $this->organisme->updateAdress($adress);

        $this->assertEquals('adresse2', $this->organisme->fresh()->adress->adresse);
    }

    /** @test */
    function it_can_add_president()
    {
        $person = raw(Person::class, [
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw(Adress::class),
        ]);

        $this->organisme->addPresident($person);

        $this->assertEquals($person['nom'], $this->organisme->president->nom);
        $this->assertInstanceOf(Person::class, $this->organisme->president);
    }

    /** @test */
    function it_can_update_president()
    {
        $person1 = raw(Person::class, [
            'nom' => 'El Presidente',
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw(Adress::class, ['adresse' => 'adresse1']),
        ]);

        $this->organisme->addPresident($person1);

        $person2 = raw(Person::class, [
            'nom' => 'El Otra Presidente',
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw(Adress::class, ['adresse' => 'adresse2']),
        ]);

        $this->organisme->updatePresident($person2);

        $this->assertEquals($person2['nom'], $this->organisme->fresh()->president->nom);
        $this->assertEquals($person2['adress']['adresse'], $this->organisme->fresh()->president->adress->adresse);
    }

    /** @test */
    function it_can_add_employe()
    {
        $person = raw(Person::class, [
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw(Adress::class),
        ]);

        $this->organisme->addEmploye($person);

        $this->assertEquals($person['nom'], $this->organisme->employe->nom);
        $this->assertInstanceOf(Person::class, $this->organisme->employe);
    }

    /** @test */
    function it_can_update_employe()
    {
        $person1 = raw(Person::class, [
            'nom' => 'El employe',
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw(Adress::class, ['adresse' => 'adresse1']),
        ]);

        $this->organisme->addEmploye($person1);

        $person2 = raw(Person::class, [
            'nom' => 'El Otra employe',
            'contactable_id' => null,
            'contactable_type' => null,
            'adress_id' => null,
            'adress' => raw(Adress::class, ['adresse' => 'adresse2']),
        ]);

        $this->organisme->updateEmploye($person2);

        $this->assertEquals($person2['nom'], $this->organisme->fresh()->employe->nom);
        $this->assertEquals($person2['adress']['adresse'], $this->organisme->fresh()->employe->adress->adresse);
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

    function it_can_list_all_organismes_in_json()
    {

    }
}
