<?php

namespace App\Http\Controllers;

use App\Adress;
use App\Beneficiaire;
use App\Benevole;
use App\Filters\BenevoleFilters;
use App\Http\Requests\StorePerson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BenevoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BenevoleFilters $filters)
    {
        $benevoles = Benevole::with(['adress'])->filter($filters)->get();

        $filters = $filters->getFilters();

        return view('benevole.index', compact(['benevoles', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('benevole.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerson $request)
    {
        $benevole = new Benevole();

        $benevole->fill(array_except($request->toArray(), $benevole->getRelationsToHandleOnStore()));

        $benevole->save();

        $benevole->handleRelationsOnStore($request->toArray());

        return redirect($benevole->path())
            ->with('flash', 'Bénévole créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Benevole $benevole
     * @return \Illuminate\Http\Response
     */
    public function show(Benevole $benevole)
    {
        $benevole->load('interets.category', 'competences.category', 'services.beneficiaire');

        return view('benevole.show', compact('benevole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Benevole $benevole
     * @return \Illuminate\Http\Response
     */
    public function edit(Benevole $benevole)
    {
        $benevole = $benevole->load(['clienteles', 'interets', 'competences']);
        return view('benevole.edit', compact('benevole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Benevole $benevole
     * @return \Illuminate\Http\Response
     */
    public function update(StorePerson $request, $id)
    {
        $benevole = Benevole::find($id);
        $benevole->update(array_except($request->toArray(), $benevole->getRelationsToHandleOnStore()));

        $benevole->handleRelationsOnUpdate($request->toArray());

        return redirect('/benevoles')
            ->with('flash', 'Bénévole modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Benevole $benevole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Benevole $benevole)
    {
        if (Gate::denies('can-delete')) {
            abort(403, 'Seuls les administrateurs peuvent supprimer des entrées.');
        }

        $benevole->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/benevoles')
            ->with('flash', 'Bénévole supprimé avec succès.');
    }

    public function restore($id)
    {
        $benevole = Benevole::withTrashed()->find($id);
        $benevole->restore();
        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/benevoles')
            ->with('flash', 'Bénévole restauré avec succès.');
    }

    public function listAllForAutocomplete()
    {
        return Benevole::get([
            'id',
            'nom',
            'prenom',
        ])->toJSON();
    }
}
