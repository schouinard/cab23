<?php

namespace App;

class Service extends FilterableModel
{
    protected $with = ['competence'];

    public function benevole()
    {
        return $this->belongsTo(Benevole::class)->withTrashed();
    }

    public function serviceable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    public static function latest()
    {
        return Service::with(['benevole', 'serviceable'])->orderBy('created_at', 'desc')->limit(50)->get();
    }
}
