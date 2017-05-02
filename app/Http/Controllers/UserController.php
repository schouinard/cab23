<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Filters\UserFilters;
use App\User;
use function foo\func;
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

        return view('users.index', compact('users'));
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
        abort_if(! auth()->user()->isAdmin, 403);
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
        abort_if(! auth()->user()->isAdmin, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(! auth()->user()->isAdmin, 403);
    }
}
