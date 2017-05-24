<?php

namespace App\Http\Controllers;

use App;
use App\Beneficiaire;
use App\Tournee;
use Illuminate\Http\Request;

class TourneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tournee.index', ['items' => Tournee::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tournee $tournee)
    {
        $beneficiaires = $tournee->getPriorityListing();

        return view('tournee.show', compact(['tournee', 'beneficiaires']));
    }

    public function moveUp(Tournee $tournee, Beneficiaire $beneficiaire)
    {
        $tournee->moveUp($beneficiaire->id);

        return redirect($tournee->path());
    }

    public function moveDown(Tournee $tournee, Beneficiaire $beneficiaire)
    {
        $tournee->moveDown($beneficiaire->id);

        return redirect($tournee->path());
    }

    public function printAlpha(Tournee $tournee)
    {
        $clients = $tournee->getAlphabeticalListing();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('print.tournee', [
            'tournee' => $tournee,
            'title' => 'Feuille de route - Copie du bureau',
            'clients' => $clients,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function print(Tournee $tournee)
    {
        $clients = $tournee->getPriorityListing();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('print.tournee', [
            'tournee' => $tournee,
            'title' => 'Feuille de route',
            'clients' => $clients,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printConducteur(Tournee $tournee)
    {
        $pdf = App::make('dompdf.wrapper');
        $clients = $tournee->getPriorityListing();
        $pdf->loadView('print.conducteur', [
            'tournee' => $tournee,
            'title' => 'Feuille de route',
            'clients' => $clients,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();

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
