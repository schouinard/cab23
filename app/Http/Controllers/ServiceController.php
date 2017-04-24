<?php

namespace App\Http\Controllers;

use App\Benevole;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Benevole $benevole)
    {
        $benevole->addService([
            'type_id' => request('type_id'),
            'beneficiaire_id' => request('beneficiaire_id'),
            'rendu_le' => request('rendu_le')
        ]);
        return back();
    }
}