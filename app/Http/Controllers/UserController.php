<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Filters\UserFilters;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilters $filters)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Seuls les administrateurs peuvent gérer les utilisateurs.');
        }
        $users = User::filter($filters)->get();

        $filters = $filters->getFilters();

        return view('users.index', compact(['users', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Seuls les administrateurs peuvent gérer les utilisateurs.');
        }

        $params = [
            'title' => 'Créer un nouvel utilisateur',
        ];

        return view('users.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Seuls les administrateurs peuvent gérer les utilisateurs.');
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'isAdmin' => $request->input('isAdmin'),
        ]);

        return redirect()->route('users.index')
            ->with('flash', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Gate::denies('manage-users') && auth()->user()->id != $user->id) {
            abort(403, 'Seuls les administrateurs peuvent gérer les utilisateurs.');
        }

        return view('users.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Seuls les administrateurs peuvent gérer les utilisateurs.');
        }

        try {
            $user = User::findOrFail($id);
            $params = [
                'title' => 'Modifier l\'utilisateur',
                'user' => $user,
            ];

            return view('users.edit', $params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
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
        if (Gate::denies('manage-users')) {
            abort(403, 'Seuls les administrateurs peuvent gérer les utilisateurs.');
        }

        try {
            $user = User::findOrFail($id);
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
            ]);
            $user->email = $request->input('email');
            $user->isAdmin = $request->input('isAdmin');
            $user->save();

            return redirect()->route('users.index')->with('flash', 'Utilisateur modifié avec succès.');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('can-delete')) {
            abort(403, 'Seuls les administrateurs peuvent supprimer des entrées.');
        }

        $user->delete();
        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect()->route('users.index')
            ->with('flash', 'Utilisateur supprimé avec succès.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        if (request()->wantsJson()) {
            return response([], 200);
        }

        return redirect()->route('users.index')
            ->with('flash', 'Utilisateur restauré avec succès.');
    }
}
