<?php

namespace App\Http\Controllers;

use App\Adress;
use App\Filters\OrganismeFilters;
use App\Organisme;
use App\OrganismeType;
use App\Person;
use Illuminate\Http\Request;

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

        return view('organisme.index', compact('organismes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisme = $this->initializeOrganismeForCreation();

        return view('organisme.create', [
            'readonly' => false,
            'organisme' => $organisme,
        ]);
    }

    public function initializeOrganismeForCreation()
    {
        $organisme = new Organisme();
        $organisme->adress = new Adress();
        $president = new Person();
        $employe = new Person();
        $president->adress = new Adress();
        $president->lien = 'Président';
        $employe->adress = new Adress();
        $employe->lien = 'Employé';
        $organisme->people->add($president);
        $organisme->people->add($employe);

        return $organisme;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
