<?php

namespace Tests\Feature;

use App\Beneficiaire;
use App\Tournee;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PopoteTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  \App\Tournee */
    protected $tournee;

    public function setUp()
    {
        parent::setUp();
        $this->signIn(User::find(1));
        $this->withExceptionHandling();
        $this->tournee = create(Tournee::class);
    }

    /** @test */
    function une_tournee_a_un_nom()
    {
        $tournee = create(Tournee::class, ['nom' => 'Tournee1']);
        $this->assertEquals('Tournee1', $tournee->nom);
    }

    /** @test */
    function une_tournee_a_un_url()
    {
        $this->assertNotNull($this->tournee->path());
    }

    /** @test */
    function on_peut_ajouter_des_jours_de_passage_a_une_tournee()
    {
        $this->tournee->addDays([1, 2, 3]);

        $this->assertCount(3, $this->tournee->days);
    }

    /** @test */
    function on_peut_ajouter_des_beneficiaires()
    {
        $beneficiaires = create(Beneficiaire::class, [], 10);

        foreach ($beneficiaires as $beneficiaire) {
            $this->tournee->addBeneficiaire($beneficiaire->id);
        }

        $this->assertCount(10, $this->tournee->fresh()->beneficiaires);
    }

    /** @test */
    function on_peut_donner_une_priorite_en_ajoutant_un_beneficiaire()
    {
        $beneficiaire = create(Beneficiaire::class);

        $this->tournee->addBeneficiaire($beneficiaire->id, 3);

        $this->assertEquals(3, $beneficiaire->fresh()->tournee_priorite);
    }

    /** @test */
    function on_peut_indiquer_si_un_beneficiaire_a_payé()
    {
        $beneficiaire = create(Beneficiaire::class);

        $this->tournee->addBeneficiaire($beneficiaire->id, null, true);

        $this->assertTrue($beneficiaire->fresh()->tournee_payee);
    }

    function on_peut_ajouter_une_note_pour_un_beneficiaire()
    {
        $beneficiaire = create(Beneficiaire::class);

        $note = 'Allergique aux poissons.';

        $this->tournee->addBeneficiaire($beneficiaire->id, null, false, $note);

        $this->assertEquals($note, $beneficiaire->fresh()->tournee_note);
    }

    /** @test */
    function on_peut_lister_les_beneficiaires_en_ordre_alphabetique()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id);
        $this->tournee->addBeneficiaire($beneficiaire2->id);
        $this->tournee->addBeneficiaire($beneficiaire3->id);
        $this->tournee->addBeneficiaire($beneficiaire4->id);

        $this->assertEquals($beneficiaire2->nom, $this->tournee->getAlphabeticalListing()->first()->nom);
    }

    /** @test */
    function on_peut_lister_les_beneficiaires_en_ordre_de_priorite()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id, 4);
        $this->tournee->addBeneficiaire($beneficiaire2->id, 2);
        $this->tournee->addBeneficiaire($beneficiaire3->id, 1);
        $this->tournee->addBeneficiaire($beneficiaire4->id, 3);

        $this->assertEquals($beneficiaire3->nom, $this->tournee->getPriorityListing()->first()->nom);
    }

    /** @test */
    function on_peut_voir_la_liste_des_tournees()
    {
        $tournees = create(Tournee::class, [], 10);
        $this->get('tournees')->assertSee($tournees->first()->nom);
    }

    /** @test */
    function sur_la_page_de_la_tournee_on_peut_voir_la_liste_des_beneficiaires()
    {
        $beneficiaires = create(Beneficiaire::class, [], 10);

        foreach ($beneficiaires as $beneficiaire) {
            $this->tournee->addBeneficiaire($beneficiaire->id);
        }

        $this->get($this->tournee->path())->assertSee($this->tournee->fresh()->beneficiaires->first()->nom);
    }

    /** @test */
    function quand_on_ajoute_un_beneficiaire_il_tombe_en_derniere_priorite()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id, 4);
        $this->tournee->addBeneficiaire($beneficiaire2->id, 2);
        $this->tournee->addBeneficiaire($beneficiaire3->id, 1);
        $this->tournee->addBeneficiaire($beneficiaire4->id, 3);

        $beneficiaire5 = create(Beneficiaire::class);
        $this->tournee->addBeneficiaire($beneficiaire5->id);

        $this->assertEquals(5, $beneficiaire5->fresh()->tournee_priorite);
    }

    /** @test */
    function on_peut_augmenter_la_priorite_dun_beneficiaire()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id, 4);
        $this->tournee->addBeneficiaire($beneficiaire2->id, 2);
        $this->tournee->addBeneficiaire($beneficiaire3->id, 1);
        $this->tournee->addBeneficiaire($beneficiaire4->id, 3);

        $this->tournee->moveUp($beneficiaire2->id);

        $this->assertEquals(1, $beneficiaire2->fresh()->tournee_priorite);
        $this->assertEquals(2, $beneficiaire3->fresh()->tournee_priorite);
    }

    /** @test */
    function on_peut_diminuer_la_priorite_dun_beneficiaire()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id, 4);
        $this->tournee->addBeneficiaire($beneficiaire2->id, 2);
        $this->tournee->addBeneficiaire($beneficiaire3->id, 1);
        $this->tournee->addBeneficiaire($beneficiaire4->id, 3);

        $this->tournee->moveDown($beneficiaire2->id);

        $this->assertEquals(3, $beneficiaire2->fresh()->tournee_priorite);
        $this->assertEquals(2, $beneficiaire4->fresh()->tournee_priorite);
    }

    /** @test */
    function on_ne_peut_pas_augmenter_la_priorite_du_premier()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id, 4);
        $this->tournee->addBeneficiaire($beneficiaire2->id, 2);
        $this->tournee->addBeneficiaire($beneficiaire3->id, 1);
        $this->tournee->addBeneficiaire($beneficiaire4->id, 3);

        $this->tournee->moveUp($beneficiaire3->id);

        $this->assertEquals(1, $beneficiaire3->fresh()->tournee_priorite);
    }

    /** @test */
    function on_ne_peut_pas_descendre_la_priorite_du_dernier()
    {
        $beneficiaire1 = create(Beneficiaire::class, ['nom' => 'Tremblay']);
        $beneficiaire2 = create(Beneficiaire::class, ['nom' => 'Bastien']);
        $beneficiaire3 = create(Beneficiaire::class, ['nom' => 'Gilbert']);
        $beneficiaire4 = create(Beneficiaire::class, ['nom' => 'Chouinard']);

        $this->tournee->addBeneficiaire($beneficiaire1->id, 4);
        $this->tournee->addBeneficiaire($beneficiaire2->id, 2);
        $this->tournee->addBeneficiaire($beneficiaire3->id, 1);
        $this->tournee->addBeneficiaire($beneficiaire4->id, 3);

        $this->tournee->moveDown($beneficiaire1->id);

        $this->assertEquals(4, $beneficiaire1->fresh()->tournee_priorite);
    }
}
