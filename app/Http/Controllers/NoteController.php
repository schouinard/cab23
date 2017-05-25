<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        Note::create($request->toArray());

        return redirect(\URL::previous().'#notes')
            ->with('flash', 'Note ajoutée.');
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
        Note::find($id)->update($request->toArray());

        return redirect(\URL::previous().'#notes')
            ->with('flash', 'Note modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::destroy($id);

        return redirect(\URL::previous().'#notes')
            ->with('flash', 'Note supprimée.');
    }
}
