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

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addServiceRequest($requestId, $attributes = [])
    {
        $this->serviceRequests()->sync($requestId, $attributes);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }
}
