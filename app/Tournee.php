<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournee extends Model
{
    protected $guarded = [];

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }

    public function beneficiaires()
    {
        return $this->hasMany(Beneficiaire::class)->with(['adress', 'people']);
    }

    //
    public function addDays($array)
    {
        $this->days()->sync($array);
    }

    public function addBeneficiaire($id, $priority = 0, $paye = false, $note = '')
    {
        $beneficiaire = Beneficiaire::find($id);
        $this->beneficiaires_count++;
        if (is_null($paye)) {
            $paye = $beneficiaire->tournee_paye;
        }
        if (is_null($note)) {
            $note = $beneficiaire->tournee_note;
        }
        if (! $priority) {
            $priority = $this->beneficiaires_count;
        }
        $beneficiaire->update([
                'tournee_id' => $this->id,
                'tournee_priorite' => $priority,
                'tournee_payee' => $paye,
                'tournee_note' => $note,
            ]
        );
    }

    public function getAlphabeticalListing()
    {
        return $this->beneficiaires()->orderBy('nom')->get();
    }

    public function getPriorityListing()
    {
        return $this->beneficiaires()->orderBy('tournee_priorite')->get();
    }

    public function path()
    {
        return '/tournees/'.$this->id;
    }

    public function moveUp($id)
    {
        $beneficiaire = Beneficiaire::find($id);
        if ($beneficiaire->tournee_priorite > 1) {
            $beneficiaireToMoveDown = Beneficiaire::where('tournee_id', $this->id)
                ->where('tournee_priorite', $beneficiaire->tournee_priorite - 1)
                ->first();

            $beneficiaire->update(['tournee_priorite' => $beneficiaire->tournee_priorite - 1]);
            $beneficiaireToMoveDown->update(['tournee_priorite' => $beneficiaireToMoveDown->tournee_priorite + 1]);
        }
    }

    public function moveDown($id)
    {
        $beneficiaire = Beneficiaire::find($id);
        if ($beneficiaire->tournee_priorite < $this->beneficiaires_count) {
            $beneficiaireToMoveUp = Beneficiaire::where('tournee_id', $this->id)
                ->where('tournee_priorite', $beneficiaire->tournee_priorite + 1)
                ->first();

            $beneficiaire->update(['tournee_priorite' => $beneficiaire->tournee_priorite + 1]);
            $beneficiaireToMoveUp->update(['tournee_priorite' => $beneficiaireToMoveUp->tournee_priorite - 1]);
        }
    }
}
