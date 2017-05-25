<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function competences()
    {
        return $this->hasMany(Competence::class)->orderBy('nom');
    }
}
