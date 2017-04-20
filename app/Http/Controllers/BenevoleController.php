<?php

namespace App\Http\Controllers;

use App\Benevole;
use Illuminate\Http\Request;

class BenevoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benevoles = Benevole::all();
        return view('benevole.index', ['benevoles' => $benevoles]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Benevole  $benevole
     * @return \Illuminate\Http\Response
     */
    public function show(Controller $benevole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Benevole  $benevole
     * @return \Illuminate\Http\Response
     */
    public function edit(Controller $benevole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Benevole  $benevole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Controller $benevole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Benevole  $benevole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Controller $benevole)
    {
        //
    }
}
