<?php

namespace App\Filters;

class OrganismeFilters extends Filters
{
    protected $filters = ['statut', 'secteur'];

    protected $sessionKey = 'organismes.filter';
}