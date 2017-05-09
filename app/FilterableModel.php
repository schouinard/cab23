<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class FilterableModel extends Model
{
    use RecordsActivity;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [];

    public static function scopeFilter($query, $filters = [])
    {
        return $filters->apply($query);
    }
}