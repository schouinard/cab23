<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benevole extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'telephone2',
        'adresse',
        'ville',
        'codePostal',
        'province',
        'naissance',
        'email',
        'contactUrgenceNom',
        'contactUrgenceTel',
    ];

    public function path()
    {
        return '/benevoles/'.$this->id;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
