<?php
/**
 * Created by PhpStorm.
 * User: schouinard
 * Date: 14/08/17
 * Time: 10:04 AM
 */

namespace tests\Unit;

use App\Organisme;
use App\Adress;
use App\OrganismeType;
use App\Person;
use App\Secteur;
use App\Mission;
use App\Regroupement;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrganismeTest extends TestCase
{

    use DatabaseMigrations;

    /** @var  Organisme */
    protected $organisme;

    public function setUp()
    {
        parent::setUp();
        $this->organisme = create(Organisme::class);
    }

    /** @test */
    function it_has_a_type()
    {
        $this->assertInstanceOf(OrganismeType::class, $this->organisme->type);
    }

    /** @test */
    function it_has_a_mission()
    {
        $this->assertInstanceOf(Mission::class, $this->organisme->mission);
    }

    /** @test */
    function it_has_a_description()
    {
        $this->assertNotNull($this->organisme->mission_desc);
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
    function it_has_an_adress()
    {
        $adress = create(Adress::class);
        $this->organisme->adress_id = $adress->id;

        $this->assertInstanceOf(Adress::class, $this->organisme->adress);
        $this->assertEquals($adress->adresse, $this->organisme->adress->adresse);
    }

}