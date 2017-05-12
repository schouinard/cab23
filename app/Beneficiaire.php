<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends FilterableModel
{
    protected $appends = ['nom_complet'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'naissance',
    ];

    protected $with = ['adress', 'facturation'];

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
        return $this->belongsToMany(ServiceType::class, 'service_requests', 'beneficiaire_id', 'service_type_id');
    }

    public function autonomies()
    {
        return $this->belongsToMany(Autonomie::class);
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addServiceRequest($requestId, $attributes = [])
    {
        $this->serviceRequests()->sync($requestId, $attributes);
    }

    public function addAutonomie($autonomies = [])
    {
        $this->autonomies()->sync($autonomies);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function addEtatSante($int)
    {
        $this->etats_sante()->sync($int);
    }

    public function etats_sante()
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
}
