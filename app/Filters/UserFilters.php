<?php

namespace App\Filters;

class UserFilters extends Filters
{
    protected $filters = ['statut'];

    protected $sessionKey = 'users.filters';

}