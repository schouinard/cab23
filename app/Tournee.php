<?php

namespace App;

class Tournee extends FilterableModel
{
    protected $guarded = [];

    protected $with = ['beneficiaires'];

    protected $relationsToHandleOnStore = ['days'];

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }

    public function beneficiaires()
    {
        return $this->belongsToMany(Beneficiaire::class)
            ->with(['adress', 'people'])
            ->withPivot('priorite', 'payee', 'note');
    }

    public function syncDays($ids)
    {
        $this->days()->sync($ids);
    }

    public function addDays($ids)
    {
        $this->syncDays($ids);
    }

    public function updateDays($ids)
    {
        $this->syncDays($ids);
    }

    public function addBeneficiaire($id, $priorite = null, $paye = false, $note = '')
    {
        $beneficiaire = Beneficiaire::find($id);

        if ($priorite == null) {
            $priorite = $this->fresh()->beneficiaires->count();
        }

        $this->beneficiaires()->attach($id, ['priorite' => $priorite, 'payee' => $paye, 'note' => $note]);
    }

    public function getAlphabeticalListing()
    {
        return $this->beneficiaires()->orderBy('nom')->get();
    }

    public function getPriorityListing()
    {
        return $this->beneficiaires()->orderBy('pivot_priorite')->get();
    }

    public function path()
    {
        return '/tournees/' . $this->id;
    }

    public function moveUp($id)
    {
        $beneficiaire = $this->beneficiaires->where('pivot.beneficiaire_id', $id)->first();
        if ($beneficiaire->pivot->priorite > 0) {
            $beneficiaireToMoveDown = $this->beneficiaires
                ->where('pivot.priorite', $beneficiaire->pivot->priorite - 1)
                ->first();
            $beneficiaire->tournees()->updateExistingPivot($this->id, ['priorite' => $beneficiaire->pivot->priorite - 1]);
            $beneficiaireToMoveDown->tournees()->updateExistingPivot($this->id, ['priorite' => $beneficiaireToMoveDown->pivot->priorite + 1]);
        }
    }

    public function moveDown($id)
    {
        $beneficiaire = $this->beneficiaires->where('pivot.beneficiaire_id', $id)->first();
        if ($beneficiaire->pivot->priorite < $this->beneficiaires->count()) {
            $beneficiaireToMoveUp = $this->beneficiaires
                ->where('pivot.priorite', $beneficiaire->pivot->priorite + 1)
                ->first();
            $beneficiaire->tournees()->updateExistingPivot($this->id, ['priorite' => $beneficiaire->pivot->priorite + 1]);
            $beneficiaireToMoveUp->tournees()->updateExistingPivot($this->id, ['priorite' => $beneficiaireToMoveUp->pivot->priorite - 1]);
        }
    }

    public function removeBeneficiaire($id)
    {
        $this->beneficiaires()->detach($id);
        $this->reorderPriorities();
    }

    public function reorderPriorities()
    {
        $beneficiaires = $this->getPriorityListing();

        for ($x = 0; $x < count($beneficiaires); $x++) {
            $beneficiaires[$x]->tournees()->updateExistingPivot($this->id, ['priorite' => $x]);
        }
    }
}
