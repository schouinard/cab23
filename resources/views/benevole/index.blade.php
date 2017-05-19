@extends('layouts.adminlte')

@section('title', 'Liste des bénévoles')

@section('content_header')
    <h1>Bénévoles</h1>
@stop

@section('content')
    <div class="row">
        @component('components.filtres')
            @slot('inputFilters')
                <div class="form-group col-md-3">
                    {{ Form::label('secteur', 'Secteur:') }}
                    {{ Form::select('secteur', $secteurs->pluck('nom','id'),isset($filters['secteur']) ? $filters['secteur'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('type', 'Mois de naissance:') }}
                    {{ Form::select('anniversaire', $months,isset($filters['anniversaire']) ? $filters['anniversaire'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('accepte_ca', 'Accepté au CA:') }}
                    {{ Form::select('accepte_ca', ['accepte' => 'Accepté', 'probation' => 'Probation'],isset($filters['accepte_ca']) ? $filters['accepte_ca'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('statut', 'Statut:') }}
                    {{ Form::select('statut', ['Inactifs' => 'Inactifs', 'Tous' => 'Tous'],isset($filters['statut']) ? $filters['statut'] : null, ['class' => 'form-control', 'placeholder' => 'Actifs']) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('inscription', 'Année d\'inscription:') }}
                    {{ Form::selectYear('inscription', 1980, Carbon\Carbon::now()->year, isset($filters['inscription']) ? $filters['inscription'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
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
                        <th>Prenom</th>
                        <th>Courriel</th>
                        <th>Telephone</th>
                        @if(request('secteur'))
                            <th>Secteur</th>
                        @endif
                        @if(request('anniversaire'))
                            <th>Anniversaire</th>
                        @endif
                        @if(request('accepte_ca'))
                            <th>Accepté</th>
                        @endif
                        @if(request('inscription') || request('accepte_ca'))
                            <th>Inscription</th>
                        @endif
                        @if(request('statut'))
                            <th>Statut</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($benevoles as $benevole)
                        <tr>
                            <td>{{ $benevole->id }}</td>
                            <td><a href="{{ $benevole->path() }}">{{ $benevole->nom }}</a></td>
                            <td>{{ $benevole->prenom }}</td>
                            <td>{{ $benevole->adress->email }}</td>
                            <td>{{ $benevole->adress->telephone }}</td>
                            @if(request('secteur'))
                                <td>
                                    @if($benevole->adress->secteur_id)
                                        {{$secteurs->where('id', $benevole->adress->secteur_id)->first()->nom}}
                                    @endif
                                </td>
                            @endif
                            @if(request('anniversaire'))
                                <td>
                                    @if($benevole->naissance)
                                        {{ $benevole->naissance->format('d M') }}
                                    @endif
                                </td>
                            @endif
                            @if(request('accepte_ca') && $benevole->accepte_ca)
                                <td>{{ $benevole->accepte_ca->format('Y-m-d') }}</td>
                            @elseif(request('accepte_ca'))
                                <td>En probation</td>
                            @endif
                            @if(request('inscription') || request('accepte_ca'))
                                <td>{{ $benevole->inscription->format('Y-m-d') }}</td>
                            @endif
                            @if(request('statut'))
                                <td>
                                    {{ $benevole->trashed() ? 'Inactif' : 'Actif' }}
                                </td>
                            @endif
                            <td>
                                <a href="{{ route('benevoles.edit', $benevole->id) }}" title="Modifier">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Modifier
                                    </button>
                                </a>
                                @can('can-delete')
                                    @if($benevole->trashed())
                                        {!! Form::open([
                                            'method'=>'POST',
                                            'url' => ['/benevoles/' . $benevole->id . '/restore'],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
                                        [
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-xs',
                                                'title' => 'Restaurer le bénévole',

                                        ]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/benevoles', $benevole->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Supprimer le bénévole',
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