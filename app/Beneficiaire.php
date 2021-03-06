<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiaire extends FilterableModel
{
    use SoftDeletes;

    protected $appends = ['nom_complet'];

    protected $casts = ['tournee_payee' => 'boolean'];

    protected $relationsToHandleOnStore = [
        'serviceRequests',
        'autonomies',
        'etatsSante',
        'adress',
        'facturation',
        'people',
        'days',
        'tournees',
    ];

    public function path()
    {
        return '/beneficiaires/' . $this->id;
    }

    public function services()
    {
        return $this->morphMany(Service::class, 'serviceable');
    }

    public function serviceRequests()
    {
        return $this->belongsToMany(Competence::class, 'service_requests', 'beneficiaire_id', 'competence_id')
            ->orderBy('nom')
            ->withPivot('service_request_status_id');
    }

    public function tournees()
    {
        return $this->belongsToMany(Tournee::class)->withPivot('priorite', 'payee', 'note');
    }

    public function autonomies()
    {
        return $this->belongsToMany(Autonomie::class);
    }

    public function etatsSante()
    {
        return $this->belongsToMany(EtatSante::class);
    }

    public function income_source()
    {
        return $this->belongsTo(IncomeSource::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable')->orderBy('date', 'DESC');;
    }

    public function adress()
    {
        return $this->belongsTo(Adress::class);
    }

    public function facturation()
    {
        return $this->belongsTo(Adress::class);
    }

    public function people()
    {
        return $this->morphMany(Person::class, 'contactable');
    }

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }

    public function getSelectedDaysAttribute()
    {
        return $this->days->pluck('id')->toArray();
    }

    public function isPopoteDay($day_id)
    {
        return !$this->days->contains('id', $day_id);
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

    public function getNomCompletAttribute()
    {
        $nom = "{$this->prenom} {$this->nom}";

        return $this->trashed() ? $nom . " (INACTIF)" : $nom;
    }

    public function getDisplayNomAttribute()
    {
        $nom = "{$this->nom}, {$this->prenom}";

        return $this->trashed() ? $nom . " (INACTIF)" : $nom;
    }

    public function getNaissanceAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getAnniversaireAttribute()
    {
        return Carbon::parse($this->naissance)->format('d/m/Y');
    }

    public function addEtatsSante($int)
    {
        $this->etatsSante()->sync($int);
    }

    public function updateEtatsSante($int)
    {
        $this->addEtatsSante($int);
    }

    public function addAdress($adress)
    {
        if (is_array($adress)) {
            $adress = Adress::create($adress);
        }
        $this->adress()->associate($adress);
        $this->save();
    }

    public function updateAdress($adress)
    {
        $this->adress()->update($adress);
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addServiceRequests($requestId, $attributes = [])
    {
        $this->serviceRequests()->sync($requestId, $attributes);
    }

    public function isServiceRequested($id, $status)
    {
        return count($this->serviceRequests->where('pivot.service_request_status_id', $status)->where('id', $id));
    }

    public function updateServiceRequests($ids = [])
    {
        $this->addServiceRequests($ids);
    }

    public function addAutonomies($autonomies = [])
    {
        $this->autonomies()->sync($autonomies);
    }

    public function updateAutonomies($autonomies = [])
    {
        $this->addAutonomies($autonomies);
    }

    public function addPeople($people = [])
    {
        if (!is_null($people)) {
            foreach ($people as $person) {
                $adress = Adress::create($person['adress']);
                $person = new Person(array_except($person, ['adress']));
                $person->adress()->associate($adress);
                $this->people()->save($person);
            }
        }
    }

    public function updatePeople($people)
    {
        foreach ($people as $person) {
            $oldPerson = Person::find($person['id']);
            $oldPerson->adress()->update($person['adress']);
            $oldPerson->update(array_except($person, ['adress']));
        }
    }

    public function addFacturation($adress)
    {
        if (is_array($adress)) {
            $adress = Adress::create($adress);
        }
        $this->facturation()->associate($adress);
        $this->save();
    }

    public function updateFacturation($adress)
    {
        $this->facturation()->update($adress);
    }

    public function updateTournees($tournees)
    {
        foreach ($tournees as $tournee) {
            $payee = false;
            if (array_key_exists('payee', $tournee)) {
                $payee = true;
            }
            $this->tournees()->updateExistingPivot($tournee['id'], ['payee' => $payee, 'note' => $tournee['note']]);
        }
    }
}
