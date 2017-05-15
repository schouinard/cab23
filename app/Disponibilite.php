<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    protected $guarded = [];

    protected $with = ['day', 'moment'];

    public function benevole()
    {
        return $this->belongsTo(Benevole::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function moment()
    {
        return $this->belongsTo(Moment::class);
    }
}
