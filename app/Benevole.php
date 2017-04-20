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
        'contactUrgenceTel'];
}
