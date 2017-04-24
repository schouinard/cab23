<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benevole extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/benevoles/'.$this->id;
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
