<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    protected $dates = [
        'date',
    ];

    protected $dateFormat = 'Y-m-d';

    public function notable()
    {
        return $this->morphTo();
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getDateForHumansAttribute()
    {
        return Carbon::parse($this->date)->diffForHumans();
    }
}
