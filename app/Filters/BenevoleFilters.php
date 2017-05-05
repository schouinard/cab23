<?php

namespace App\Filters;

class BenevoleFilters extends Filters
{
    protected $filters = ['anniversaire', 'quartier', 'statut'];

    public function anniversaire($month)
    {
        return $this->builder->whereMonth('naissance', $month);
    }

    public function quartier($quartier)
    {
        return $this->builder->where('quartier_id', $quartier);
    }
}