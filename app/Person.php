<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [];
    protected $with = ['adress'];

    public function adress()
    {
        return $this->belongsTo(Adress::class);
    }
}
