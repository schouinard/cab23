<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $guarded = [];

    public static function scopeFilter($query, $filters = [])
    {
        return $filters->apply($query);
    }
}