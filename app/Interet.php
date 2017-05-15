<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interet extends Model
{
    protected $guarded = [];
    protected $with = ['categorieInteretCompetence'];

    public function categorieInteretCompetence()
    {
        $this->belongsTo(CategorieInteretCompetence::class);
    }
}
