<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $guarded = [];

    protected $with = ['secteur'];

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }
}
