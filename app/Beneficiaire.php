<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/beneficiaires/'.$this->id;
    }
}
