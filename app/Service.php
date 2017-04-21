<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function benevole()
    {
        return $this->belongsTo(Benevole::class);
    }

}
