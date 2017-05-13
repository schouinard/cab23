<?php

namespace App;

class Beneficiaire extends FilterableModel
{
    protected $appends = ['nom_complet'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'naissance',
    ];

    protected $with = ['adress', 'serviceRequests', 'facturation', 'people'];

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
        return $this->hasMany(Person::class);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function addEtatsSante($int)
    {
        $this->etatsSante()->sync($int);
    }

    public function addAdress($adress)
    {
        if (is_array($adress)) {
            $adress = Adress::create($adress);
        }
        $this->adress()->associate($adress);
        $this->save();
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addServiceRequests($requestId, $attributes = [])
    {
        $this->serviceRequests()->sync($requestId, $attributes);
    }

    public function addAutonomies($autonomies = [])
    {
        $this->autonomies()->sync($autonomies);
    }

    public function addPeople($people)
    {
        foreach ($people as $person) {
            $adress = Adress::create($person['adress']);
            $person = new Person(array_except($person, ['adress']));
            $person->adress()->associate($adress);
            $this->people()->save($person);
        }
    }
}
