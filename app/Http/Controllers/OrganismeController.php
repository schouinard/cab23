<?php

namespace App\Http\Controllers;

use App\Adress;
use App\Filters\OrganismeFilters;
use App\Organisme;
use App\OrganismeType;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrganismeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrganismeFilters $filters)
    {
        $organismes = Organisme::with('adress')->filter($filters)->get();

        $filters = $filters->getFilters();

        return view('organisme.index', compact(['organismes', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organisme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nom' => 'required',
        ]);

        $organisme = new Organisme();

        $organisme->fill(array_except($request->toArray(), $organisme->getRelationsToHandleOnStore()));

        $organisme->save();

        $organisme->handleRelationsOnStore($request->toArray());

        return redirect($organisme->path())
            ->with('flash', 'Organisme créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Organisme $organisme)
    {
        $readonly = true;

        return view('organisme.show', compact(['organisme', 'readonly']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisme $organisme)
    {
        return view('organisme.edit', compact(['organisme']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
        ]);

        $organisme = Organisme::find($id);
        $organisme->update(array_except($request->toArray(), $organisme->getRelationsToHandleOnStore()));

        $organisme->handleRelationsOnUpdate($request->toArray());

        return redirect($organisme->path())
            ->with('flash', 'Organisme modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisme $organisme)
    {
        if (Gate::denies('can-delete')) {
            abort(403, 'Seuls les administrateurs peuvent supprimer des entrées.');
        }

        $organisme->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/organismes')
            ->with('flash', 'Organisme supprimé avec succès.');
    }

    public function restore($id)
    {
        $organisme = Organisme::withTrashed()->find($id);
        $organisme->restore();
        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect('/organismes')
            ->with('flash', 'Organisme restauré avec succès.');
    }
}
