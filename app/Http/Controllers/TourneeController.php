<?php

namespace App\Http\Controllers;

use App;
use App\Beneficiaire;
use App\Http\Requests\AddClientRequest;
use App\Http\Requests\TourneeRequest;
use App\Tournee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('tournee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourneeRequest $request)
    {
        $tournee = new Tournee();

        $tournee->fill(array_except($request->toArray(), $tournee->getRelationsToHandleOnStore()));

        $tournee->save();

        $tournee->handleRelationsOnStore($request->toArray());

        return redirect('/tournees')
            ->with('flash', 'Tournée ajoutée.');
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

    public function remove(Tournee $tournee, Beneficiaire $beneficiaire)
    {
        $tournee->removeBeneficiaire($beneficiaire->id);

        return back()
            ->with('flash', 'Client retiré de la tournée');
    }

    public function add(AddClientRequest $request, Tournee $tournee)
    {
        $tournee->addBeneficiaire($request['beneficiaire_id']);

        return back()
            ->with('flash', 'Client ajouté.');
    }

    public function printAlpha(Tournee $tournee)
    {
        $clients = $tournee->getAlphabeticalListing();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('print.tournee', [
            'tournee' => $tournee,
            'title' => 'Feuille de route - Copie du bureau',
            'clients' => $clients,
        ])->setPaper('letter', 'portrait')
            ->setOption('margin-top', '5');

        return $pdf->stream();
    }

    public function print(Tournee $tournee)
    {
        $clients = $tournee->getPriorityListing();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('print.tournee', [
            'tournee' => $tournee,
            'title' => 'Feuille de route',
            'clients' => $clients,
        ])->setPaper('letter', 'portrait')
            ->setOption('margin-top', '5');

        return $pdf->inline();
    }

    public function printConducteur(Tournee $tournee)
    {
        $pdf = App::make('snappy.pdf.wrapper');
        $clients = $tournee->getAlphabeticalListing();
        $pdf->loadView('print.contacts', [
            'tournee' => $tournee,
            'title' => 'Feuille de route',
            'clients' => $clients,
        ])
            ->setPaper('letter', 'landscape')
            ->setOption('margin-top', '5');

        return $pdf->inline();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourneeRequest $request, Tournee $tournee)
    {
        $tournee->update($request->toArray());

        return back()
            ->with('flash', 'Tournée modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficiaires = Beneficiaire::where('tournee_id', $id)->get();
        foreach ($beneficiaires as $beneficiaire) {
            $beneficiaire->update(['tournee_id' => null, 'tournee_payee' => false]);
            $beneficiaire->days()->delete();
        }
        Tournee::destroy($id);

        return back()
            ->with('flash', 'Tournée supprimée');
    }
}
