<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreService;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(StoreService $request)
    {
        Service::create([
            'service_type_id' => request('service_type_id'),
            'beneficiaire_id' => request('beneficiaire_id'),
            'rendu_le' => request('rendu_le'),
            'benevole_id' => request('benevole_id'),
            'don' => request('don'),
        ]);

        return back();
    }

    public function index()
    {
        $services = Service::latest();

        return view('service.index', compact('services'));
    }
}