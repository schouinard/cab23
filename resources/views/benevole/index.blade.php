@extends('layouts.adminlte')

@section('title', 'Liste des bénévoles')

@section('content_header')
    <h1>Bénévoles</h1>
@stop

@section('content')
    <div class="row">
        @component('components.filtres', ['filters' => $filters])
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
                <!--- competence form input ---->
                <div class="form-group col-md-6 {{ $errors->first('competence', 'has-error') }}">
                    {{ Form::label('competence', 'Intérêt / Compétence:') }}
                    <select name="type" class="form-control">
                        @foreach($interestGroups as $category)
                            <option value="">Tous</option>
                            <optgroup label="{{$category->nom}}">
                                @foreach($category->competences as $competence)
                                    <option @if(isset($filters['competence']))
                                            @if($filters['competence'] == $competence->id) selected
                                            @endif
                                            @endif
                                            value="{{$competence->id}}">{{$competence->nom}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <h4 class="col-md-12">Disponibilités</h4>
                <div class="form-group col-md-3">
                    {{ Form::label('dispojour', 'Jour:') }}
                    {{ Form::select('dispojour',$days->pluck('nom','id'), isset($filters['dispojour']) ? $filters['dispojour'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                </div>
                <div class="form-group col-md-3">
                    {{ Form::label('dispomoment', 'Moment:') }}
                    {{ Form::select('dispomoment',$moments->pluck('nom','id'), isset($filters['dispomoment']) ? $filters['dispomoment'] : null, ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                </div>
                <div class="form-group col-md-3">
                    {{Form::label('isdispo', 'Est disponible le:')}}
                    <div class="input-group date datepicker">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{ Form::text('isdispo', isset($filters['isdispo']) ? $filters['isdispo'] : null, array_merge(['class' => 'form-control pull-right'])) }}
                    </div>
                </div>



            @endslot
        @endcomponent
    </div>
    <div class="row">
        @component('components.index', ['filters' => $filters])
            @slot('datatable')
                <table id="benevoles" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Courriel</th>
                        <th>Telephone</th>
                        @if(isset($filters['secteur']))
                            <th>Secteur</th>
                        @endif
                        @if(isset($filters['anniversaire']))
                            <th>Né le</th>
                            <th>Mois</th>
                            <th>Année</th>
                        @endif
                        @if(isset($filters['accepte_ca']))
                            <th>Accepté</th>
                        @endif
                        @if(isset($filters['inscription']) || isset($filters['accepte_ca']))
                            <th>Inscription</th>
                        @endif
                        @if(isset($filters['dispojour']) || isset($filters['dispomoment']) || isset($filters['isdispo']))
                            <th>Disponibilités</th>
                        @endif
                        @if(isset($filters['statut']))
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
                            @if(isset($filters['secteur']))
                                <td>
                                    @if($benevole->adress->secteur_id)
                                        {{$secteurs->where('id', $benevole->adress->secteur_id)->first()->nom}}
                                    @endif
                                </td>
                            @endif
                            @if(isset($filters['anniversaire']))
                                <td>
                                    @if($benevole->naissance)
                                        {{ \Carbon\Carbon::parse($benevole->naissance)->format('d') }}
                                    @endif
                                </td>
                                <td>
                                    @if($benevole->naissance)
                                        {{ \Carbon\Carbon::parse($benevole->naissance)->format('m') }}
                                    @endif
                                </td>
                                <td>
                                    @if($benevole->naissance)
                                        {{ \Carbon\Carbon::parse($benevole->naissance)->format('Y') }}
                                    @endif
                                </td>
                            @endif
                            @if(isset($filters['accepte_ca']) && $benevole->accepte_ca)
                                <td>{{ $benevole->accepte_ca }}</td>
                            @elseif(isset($filters['accepte_ca']))
                                <td>En probation</td>
                            @endif
                            @if(isset($filters['inscription']) || isset($filters['accepte_ca']))
                                <td>{{ $benevole->inscription }}</td>
                            @endif
                            @if(isset($filters['dispojour']) || isset($filters['dispomoment']) || isset($filters['isdispo']))
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($days as $day)
                                            @if(count($benevole->disponibilites->where('day_id', $day->id)))
                                                <li>{{$day->nom}}
                                                    : {{$benevole->disponibilites->where('day_id', $day->id)->pluck(['moment'])->pluck('nom')->implode(', ')}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            @endif
                            @if(isset($filters['statut']))
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