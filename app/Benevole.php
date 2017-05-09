<?php

namespace App;

class Benevole extends FilterableModel
{
    protected $appends = ['nom_complet'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'naissance',
        'accepte_ca',
        'inscription',
    ];

    public function path()
    {
        return '/benevoles/'.$this->id;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function clienteles()
    {
        return $this->belongsToMany(Clientele::class, 'clienteles_benevoles');
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }
}
