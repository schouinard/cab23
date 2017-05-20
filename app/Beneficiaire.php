<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiaire extends FilterableModel
{
    use SoftDeletes;

    protected $appends = ['nom_complet'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'naissance',
    ];

    protected $relationsToHandleOnStore = [
        'serviceRequests',
        'autonomies',
        'etatsSante',
        'adress',
        'facturation',
        'people',
    ];

    public function path()
    {
        return '/beneficiaires/'.$this->id;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function serviceRequests()
    {
        return $this->belongsToMany(ServiceType::class, 'service_requests', 'beneficiaire_id', 'service_type_id')
            ->withPivot('service_request_status_id');
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
        return $this->morphMany(Note::class, 'notable');
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

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function getNaissanceAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
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
        if (! is_null($people)) {
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
}
