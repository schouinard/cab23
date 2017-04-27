<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends Model
{
    protected $guarded = [];
    protected $appends = ['nom_complet'];

    public function path()
    {
        return '/beneficiaires/'.$this->id;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
