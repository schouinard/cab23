<?php

namespace App;

class Service extends FilterableModel
{
    protected $with = ['type'];

    public function benevole()
    {
        return $this->belongsTo(Benevole::class)->withTrashed();
    }

    public function serviceable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public static function latest()
    {
        return Service::with(['benevole', 'serviceable'])->orderBy('created_at', 'desc')->limit(50)->get();
    }
}
