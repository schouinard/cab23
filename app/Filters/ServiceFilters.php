<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ServiceFilters extends Filters
{

    protected $filters = ['type', 'from', 'to'];

    protected $sessionKey = 'services.filters';

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

    public function from($from)
    {
        return $this->builder->where('rendu_le', '>', $from);
    }

    public function to($to)
    {
        return $this->builder->where('rendu_le', '<', $to);
    }
}