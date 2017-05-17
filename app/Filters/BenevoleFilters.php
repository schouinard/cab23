<?php

namespace App\Filters;

class BenevoleFilters extends Filters
{
    protected $filters = ['anniversaire', 'secteur', 'statut', 'accepte_ca', 'inscription'];

    public function anniversaire($month)
    {
        return $this->builder->whereMonth('naissance', $month);
    }

    public function accepte_ca($accepte)
    {
        switch ($accepte) {
            case 'accepte' :
                return $this->builder->whereNotNull('accepte_ca');
            case 'probation' :
                return $this->builder->whereNull('accepte_ca');
            default :
                return $this->builder;
        }
    }

    public function inscription($inscription)
    {
        return $this->builder->whereYear('inscription', '=', $inscription);
    }
}