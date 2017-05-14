<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    protected $guarded = [];

    protected $with = ['dayOfTheWeek'];

    public function benevole()
    {
        $this->belongsTo(Benevole::class);
    }

    public function dayOfTheWeek()
    {
        $this->belongsTo(Day::class);
    }
}
