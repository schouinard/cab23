<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    protected $sessionKey = 'filters';

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
        if ($this->request->isMethod('PUT')) {
            $filters = $this->request->intersect($this->filters);
            $this->request->session()->put($this->sessionKey, $filters);

            return $filters;
        }

        return $this->request->session()->get($this->sessionKey, []);
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