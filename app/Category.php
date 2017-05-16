<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function interets()
    {
        return $this->hasMany(Interet::class);
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }
}
