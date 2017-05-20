<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreService;
use App\Service;
use App\Filters\ServiceFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        return back()
            ->with('flash', 'Service ajouté avec succès.');
    }

    public function index(ServiceFilters $filters)
    {
        $services = Service::filter($filters)->with(['benevole', 'serviceable'])->get();

        $filters = $filters->getFilters();

        return view('service.index', compact(['services', 'filters']));
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

        return redirect('/services')
            ->with('flash', 'Service supprimé avec succès.');
    }

    public function restore($id)
    {
        $service = Service::withTrashed()->find($id);
        $service->restore();
        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/services')
            ->with('flash', 'Service restauré avec succès.');
    }
}