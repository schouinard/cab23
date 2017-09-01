@extends('layouts.adminlte')

@section('title', 'Liste des utilisateurs')

@section('content_header')
    <h1>Utilisateurs</h1>
@stop

@section('content')
    <div class="row">
        @component('components.filtres', ['filters' => $filters])
            @slot('inputFilters')
                <div class="form-group col-md-3">
                    {{ Form::label('statut', 'Statut:') }}
                    {{ Form::select('statut', ['Actifs' => 'Actifs', 'Inactifs' => 'Inactifs', 'Tous' => 'Tous'],isset($filters['statut']) ? $filters['statut'] : null, ['class' => 'form-control', 'placeholder' => 'Actifs']) }}
                </div>
            @endslot
        @endcomponent
    </div>
    <div class="row">
        @component('components.index', ['filters' => $filters])
            @slot('datatable')
                <table class="datatable table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Courriel</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ $user->path() }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->isAdmin)
                                    Admin
                                @else
                                    Bénévole
                                @endif
                            </td>
                            <td>
                                {{ $user->trashed() ? 'Inactif' : 'Actif' }}
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" title="Modifier">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Modifier
                                    </button>
                                </a>
                                @can('can-delete')
                                    @if($user->trashed())
                                        {!! Form::open([
                                            'method'=>'POST',
                                            'url' => ['/users/' . $user->id . '/restore'],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
                                        [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-xs',
                                                'title' => 'Restaurer l\'utilisateur',

                                        ]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/users', $user->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer l\'utilisateur',
                                                'onclick'=>'return confirm("Voulez-vous vraiment supprimer?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            @endslot
        @endcomponent
    </div>
@stop