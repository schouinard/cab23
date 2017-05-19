<?php

namespace App\Filters;

class BeneficiaireFilters extends Filters
{
    protected $filters = ['secteur', 'anniversaire', 'statut'];

    protected $sessionKey = 'beneficiaires.filters';

    public function anniversaire($month)
    {
        return $this->builder->whereMonth('naissance', $month);
    }
}