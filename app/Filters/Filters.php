<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    /**
     * Filters constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }

    public function statut($statut)
    {
        switch ($statut) {
            case 'Tous' :
                return $this->builder->withTrashed();
            case 'Inactifs' :
                return $this->builder->onlyTrashed();
            default :
                return $this->builder;
        }
    }

    public function secteur($secteur)
    {
        return $this->builder->whereHas('Adress', function ($q) use ($secteur) {
            $q->where('secteur_id', $secteur);
        });
    }
}