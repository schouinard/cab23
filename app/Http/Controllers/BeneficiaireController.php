<?php

namespace App\Http\Controllers;

use App\Adress;
use App\Beneficiaire;
use App\Benevole;
use App\Filters\BeneficiaireFilters;
use App\Http\Requests\StorePerson;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BeneficiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BeneficiaireFilters $filters)
    {
        $beneficiaires = Beneficiaire::with('adress')->filter($filters)->get();

        $filters = $filters->getFilters();

        return view('beneficiaire.index', compact(['beneficiaires', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beneficiaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerson $request)
    {
        $beneficiaire = new Beneficiaire();

        $beneficiaire->fill(array_except($request->toArray(), $beneficiaire->getRelationsToHandleOnStore()));

        $beneficiaire->save();

        $beneficiaire->handleRelationsOnStore($request->toArray());

        return redirect($beneficiaire->path())
            ->with('flash', 'Bénéficiaire créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiaire = Beneficiaire::withTrashed()->with(['adress', 'people.adress'])->find($id);
        $beneficiaire->load(['services.benevole']);

        return view('beneficiaire.show', compact('beneficiaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiaire $beneficiaire)
    {
        return view('beneficiaire.edit', compact('beneficiaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $beneficiaire = Beneficiaire::find($id);
        $beneficiaire->update(array_except($request->toArray(), $beneficiaire->getRelationsToHandleOnStore()));

        $beneficiaire->handleRelationsOnUpdate($request->toArray());

        return redirect($beneficiaire->path())
            ->with('flash', 'Bénéficiaire modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiaire $beneficiaire)
    {
        if (Gate::denies('can-delete')) {
            abort(403, 'Seuls les administrateurs peuvent supprimer des entrées.');
        }

        $beneficiaire->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }

        return back()
            ->with('flash', 'Bénéficiaire supprimé avec succès.');
    }

    public function restore($id)
    {
        $beneficiaire = Beneficiaire::withTrashed()->find($id);
        $beneficiaire->restore();
        if (request()->wantsJson()) {
            return response([], 200);
        }

        return back()
            ->with('flash', 'Bénéficiaire restauré avec succès.');
    }

    public function listAllForAutocomplete()
    {
        return Beneficiaire::get([
            'id',
            'nom',
            'prenom',
        ])->toJSON();
    }
}
