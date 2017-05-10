<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieInteretCompetence extends Model
{
    protected $guarded = [];
    protected $with = ['interets', 'competences'];

    public function interets()
    {
        return $this->hasMany(Interet::class);
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }
}
