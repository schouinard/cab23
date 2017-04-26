<?php

namespace App\Http\Controllers;

use App\Beneficiaire;
use App\Benevole;
use App\Http\Requests\StorePerson;
use Illuminate\Http\Request;

class BeneficiaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaires = Beneficiaire::all();

        return view('beneficiaire.index', compact('beneficiaires'));
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
        $beneficiaire = Beneficiaire::create($request->toArray());

        return redirect($beneficiaire->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiaire $beneficiaire)
    {
        $beneficiaire = Beneficiaire::with(['services.benevole', 'services.type'])->where('id', $beneficiaire->id)->first();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiaire $beneficiaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiaire $beneficiaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiaire $beneficiaire)
    {
        //
    }
}
