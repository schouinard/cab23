<?php

namespace App\Filters;

use Carbon\Carbon;

class BenevoleFilters extends Filters
{
    protected $filters = [
        'anniversaire',
        'secteur',
        'statut',
        'accepte_ca',
        'inscription',
        'dispojour',
        'dispomoment',
        'isdispo',
    ];

    protected $sessionKey = 'benevoles.filter';

    public function anniversaire($month)
    {
        return $this->builder->whereMonth('naissance', $month);
    }

    public function accepte_ca($accepte)
    {
        switch ($accepte) {
            case 'accepte' :
                return $this->builder->whereNotNull('accepte_ca');
            default :
                return $this->builder->whereNull('accepte_ca');
        }
    }

    public function inscription($inscription)
    {
        return $this->builder->whereYear('inscription', '=', $inscription);
    }

    public function dispojour($jour)
    {
        return $this->builder->whereHas('Disponibilites', function ($q) use ($jour) {
            $q->where('day_id', $jour);
        });
    }

    public function dispomoment($moment)
    {
        return $this->builder->whereHas('Disponibilites', function ($q) use ($moment) {
            $q->where('moment_id', $moment);
        });
    }

    public function isdispo($date)
    {
        return $this->builder->whereDoesntHave('indisponibilites', function ($q) use ($date) {
            $q->where('from', '<=', $date)->where('to', '>=', $date);
        });
    }
}