<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ServiceFilters extends Filters
{

    protected $filters = ['type'];

    /**
     * Filter the query by a given type
     *
     * @param string $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->builder->where('service_type_id', $type);
    }
}