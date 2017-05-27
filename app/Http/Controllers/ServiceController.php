<?php

namespace App\Http\Controllers;

use App\Beneficiaire;
use App\Http\Requests\StoreService;
use App\Organisme;
use App\Service;
use App\Filters\ServiceFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
{
    public function store(StoreService $request)
    {
        Service::create([
            'competence_id' => request('competence_id'),
            'serviceable_id' => request('beneficiaire_id') ? request('beneficiaire_id') : request('organisme_id'),
            'serviceable_type' => request('serviceable_type'),
            'rendu_le' => request('rendu_le'),
            'benevole_id' => request('benevole_id'),
            'don' => request('don'),
            'heures' => request('heures'),
            'note' => request('note'),
        ]);

        return back()
            ->with('flash', 'Service ajouté avec succès.');
    }

    public function update(StoreService $request, Service $service)
    {
        $service->update([
            'competence_id' => request('competence_id'),
            'serviceable_id' => request('beneficiaire_id') ? request('beneficiaire_id') : request('organisme_id'),
            'serviceable_type' => request('serviceable_type'),
            'rendu_le' => request('rendu_le'),
            'benevole_id' => request('benevole_id'),
            'don' => request('don'),
            'heures' => request('heures'),
            'note' => request('note'),
        ]);

        $url = request('beneficiaire_id') ? '/services' : '/services/organismes';

        return redirect($url)
            ->with('flash', 'Service modifié avec succès.');
    }

    public function index(ServiceFilters $filters)
    {
        return $this->listServices($filters, Beneficiaire::class);
    }

    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }

    public function indexOrganismes(ServiceFilters $filters)
    {
        return $this->listServices($filters, Organisme::class);
    }

    private function listServices($filters, $serviceableType)
    {
        $services = Service::filter($filters)
            ->with(['benevole', 'serviceable'])
            ->where('serviceable_type', $serviceableType)
            ->get();

        $filters = $filters->getFilters();

        return view('service.index', compact(['services', 'filters', 'serviceableType']));
    }

    public function destroy(Service $service)
    {
        if (Gate::denies('can-delete')) {
            abort(403, 'Seuls les administrateurs peuvent supprimer des entrées.');
        }

        $service->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }

        return back()
            ->with('flash', 'Service supprimé avec succès.');
    }
}