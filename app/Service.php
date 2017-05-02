<?php

namespace App;

class Service extends BaseModel
{
    use RecordsActivity;

    protected $with = ['type'];

    public function benevole()
    {
        return $this->belongsTo(Benevole::class);
    }

    public function beneficiaire()
    {
        return $this->belongsTo(Beneficiaire::class);
    }

    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public static function latest()
    {
        return Service::with(['benevole', 'beneficiaire'])->orderBy('created_at', 'desc')->limit(50)->get();
    }
}
