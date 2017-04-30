<?php

namespace App\Filters;

class BeneficiaireFilters extends Filters
{
    protected $filters = ['quartier', 'anniversaire'];

    public function anniversaire($month)
    {
        return $this->builder->whereMonth('naissance', $month);
    }

    public function quartier($quartier)
    {
        return $this->builder->where('quartier_id', $quartier);
    }
}