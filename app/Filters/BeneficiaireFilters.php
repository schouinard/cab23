<?php

namespace App\Filters;

class BeneficiaireFilters extends Filters
{
    protected $filters = ['secteur', 'anniversaire', 'statut'];

    public function anniversaire($month)
    {
        return $this->builder->whereMonth('naissance', $month);
    }

    public function secteur($secteur)
    {
        return $this->builder->whereHas('Adress', function ($q) use ($secteur) {
            $q->where('secteur_id', $secteur);
        });
    }
}