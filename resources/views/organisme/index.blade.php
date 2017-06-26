@extends('layouts.adminlte')

@section('title', 'Liste des organismes')

@section('content_header')
    <h1>Organismes</h1>
@stop

@section('content')
    <div class="row">
        @component('components.filtres', ['filters' => $filters])
            @slot('inputFilters')
                <div class="form-group col-md-3">
                    {{ Form::label('secteur', 'Secteur:') }}
                    @include('components.select', ['name' => 'secteur', 'items' => $secteurs])
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('statut', 'Statut:') }}
                    {{ Form::select('statut', ['Actifs' => 'Actifs', 'Inactifs' => 'Inactifs', 'Tous' => 'Tous'], isset($filters['statut']) ? $filters['statut'] : null, ['class' => 'form-control', 'placeholder' => 'Actifs']) }}
                </div>
            @endslot
        @endcomponent
    </div>
    <div class="row">
        @component('components.index', ['filters' => $filters])
            @slot('datatable')
                <table id="benevoles" class=" table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Courriel</th>
                        <th>Telephone</th>
                        @if(request('secteur'))
                            <th>Secteur</th>
                        @endif
                        @if(request('statut'))
                            <th>Statut</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organismes as $organisme)
                        <tr>
                            <td>{{ $organisme->id }}</td>
                            <td><a href="{{ $organisme->path() }}">{{ $organisme->nom }}</a></td>
                            <td>{{ $organisme->adress->email }}</td>
                            <td>{{ $organisme->adress->telephone }}</td>
                            @if(request('secteur'))
                                <td>
                                    @if($organisme->adress->secteur_id)
                                        {{$secteurs->where('id', $organisme->adress->secteur_id)->first()->nom}}
                                    @endif
                                </td>
                            @endif
                            @if(request('statut'))
                                <td>
                                    {{ $organisme->trashed() ? 'Inactif' : 'Actif' }}
                                </td>
                            @endif
                            <td>
                                <a href="{{ route('organismes.edit', $organisme->id) }}" title="Modifier">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Modifier
                                    </button>
                                </a>
                                @can('can-delete')
                                    @if($organisme->trashed())
                                        {!! Form::open([
                                            'method'=>'POST',
                                            'url' => ['/organismes/' . $organisme->id . '/restore'],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
                                        [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-xs',
                                                'title' => 'Restaurer l\'organisme',

                                        ]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/organismes', $organisme->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer l\'organisme',
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