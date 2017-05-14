@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bénéficiaires</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Filtres</h3>
                    <div class="box-tools pull-right">
                        <!-- This will cause the box to collapse when clicked -->
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <form action="" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group col-md-3">
                            {{ Form::label('secteur', 'Secteur:') }}
                            {{ Form::select('secteur', $secteurs->pluck('nom','id'),request('secteur'), ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('type', 'Mois de naissance:') }}
                            {{ Form::select('anniversaire', $months,request('anniversaire'), ['class' => 'form-control', 'placeholder' => 'Tous']) }}
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('statut', 'Statut:') }}
                            {{ Form::select('statut', ['Inactifs' => 'Inactifs', 'Tous' => 'Tous'],request('statut'), ['class' => 'form-control', 'placeholder' => 'Actifs']) }}
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary" value="Filtrer"/>
                            <a href="/beneficiaires" class="btn btn-primary">Effacer les filtres</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="datatable table table-hover table-bordered">
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
                            @if(request('statut'))
                                <th>Statut</th>
                            @endif
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
                                @if(request('anniversaire'))
                                    <td>
                                        @if($beneficiaire->naissance)
                                            {{ $beneficiaire->naissance->format('d M') }}
                                        @endif
                                    </td>
                                @endif
                                @if(request('statut'))
                                    <td>
                                        {{ $beneficiaire->trashed() ? 'Inactif' : 'Actif' }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

