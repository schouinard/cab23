<?php

namespace Tests\Feature;

use App\Beneficiaire;
use App\Benevole;
use App\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    function un_benevole_a_des_notes()
    {
        $benevole = create(Benevole::class);
        create(Note::class, [
            'notable_id' => $benevole->id,
            'notable_type' => Benevole::class,
        ]);

        $this->assertInstanceOf(Note::class, $benevole->notes->first());
    }

    /** @test */
    function on_peut_voir_les_notes_sur_la_fiche_bénévole()
    {
        $benevole = create(Benevole::class);
        $note = create(Note::class, [
            'notable_id' => $benevole->id,
            'notable_type' => Benevole::class,
        ]);

        $this->get($benevole->path())->assertSee($note->text);
    }

    /** @test */
    function un_beneficiaire_a_des_notes()
    {
        $beneficiaire = create(Beneficiaire::class);
        create(Note::class, [
            'notable_id' => $beneficiaire->id,
            'notable_type' => Beneficiaire::class,
        ]);

        $this->assertInstanceOf(Note::class, $beneficiaire->notes->first());
    }

    /** @test */
    function on_peut_voir_les_notes_sur_la_fiche_bénéficiaire()
    {
        $beneficiaire = create(Beneficiaire::class);
        $note = create(Note::class, [
            'notable_id' => $beneficiaire->id,
            'notable_type' => Beneficiaire::class,
        ]);

        $this->get($beneficiaire->path())->assertSee($note->text);
    }

    /** @test */
    function un_organisme_a_des_notes()
    {
        $organisme = create(Organisme::class);
        create(Note::class, [
            'notable_id' => $organisme->id,
            'notable_type' => Organisme::class,
        ]);

        $this->assertInstanceOf(Note::class, $organisme->notes->first());
    }

}
