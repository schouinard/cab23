<?php

namespace App;

class Tournee extends FilterableModel
{
    protected $guarded = [];

    protected $with = ['beneficiaires'];

    protected $withCount = ['beneficiaires'];

    protected $relationsToHandleOnStore = ['days'];

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }

    public function beneficiaires()
    {
        return $this->hasMany(Beneficiaire::class)->with(['adress', 'people']);
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

    public function removeBeneficiaire($id)
    {
        $beneficiaire = $this->beneficiaires->where('id', $id)->first();
        if ($beneficiaire) {
            $beneficiairesToMoveUp = $this->beneficiaires->where('tournee_priorite', '>',
                $beneficiaire->tournee_priorite);
            foreach ($beneficiairesToMoveUp as $client) {
                $client->tournee_priorite--;
                $client->save();
            }
            $beneficiaire->update(['tournee_id' => null, 'tournee_priorite' => null]);
            $this->beneficiaires_count--;
        }
    }
}
