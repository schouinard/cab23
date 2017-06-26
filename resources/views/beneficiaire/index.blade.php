@extends('layouts.adminlte')

@section('title', 'Liste des bénéficiaires')

@section('content_header')
    <h1>Bénéficiaires</h1>
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
                    {{ Form::label('type', 'Mois de naissance:') }}
                    {{ Form::select('anniversaire', $months, isset($filters['anniversaire']) ? $filters['anniversaire'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
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
                <table id="benevoles" class=" table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Courriel</th>
                        <th>Telephone</th>
                        @if(request('secteur'))
                            <th>Secteur</th>
                        @endif
                        @if(isset($filters['anniversaire']))
                            <th>Né le</th>
                            <th>Mois</th>
                            <th>Année</th>
                        @endif
                        @if(request('statut'))
                            <th>Statut</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($beneficiaires as $beneficiaire)
                        <tr>
                            <td>{{ $beneficiaire->id }}</td>
                            <td><a href="{{ $beneficiaire->path() }}">{{ $beneficiaire->nom }}</a></td>
                            <td>{{ $beneficiaire->prenom }}</td>
                            <td>{{ $beneficiaire->adress->email }}</td>
                            <td>{{ $beneficiaire->adress->telephone }}</td>
                            @if(request('secteur'))
                                <td>
                                    @if($beneficiaire->adress->secteur_id)
                                        {{$secteurs->where('id', $beneficiaire->adress->secteur_id)->first()->nom}}
                                    @endif
                                </td>
                            @endif
                            @if(isset($filters['anniversaire']))
                                <td>
                                    @if($beneficiaire->naissance)
                                        {{ \Carbon\Carbon::parse($beneficiaire->naissance)->format('d') }}
                                    @endif
                                </td>
                                <td>
                                    @if($beneficiaire->naissance)
                                        {{ \Carbon\Carbon::parse($beneficiaire->naissance)->format('m') }}
                                    @endif
                                </td>
                                <td>
                                    @if($beneficiaire->naissance)
                                        {{ \Carbon\Carbon::parse($beneficiaire->naissance)->format('Y') }}
                                    @endif
                                </td>
                            @endif
                            @if(request('statut'))
                                <td>
                                    {{ $beneficiaire->trashed() ? 'Inactif' : 'Actif' }}
                                </td>
                            @endif
                            <td>
                                <a href="{{ route('beneficiaires.edit', $beneficiaire->id) }}" title="Modifier">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Modifier
                                    </button>
                                </a>
                                @can('can-delete')
                                    @if($beneficiaire->trashed())
                                        {!! Form::open([
                                            'method'=>'POST',
                                            'url' => ['/beneficiaires/' . $beneficiaire->id . '/restore'],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
                                        [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-xs',
                                                'title' => 'Restaurer le bénéficiaire',

                                        ]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/beneficiaires', $beneficiaire->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer le bénéficiaire',
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

