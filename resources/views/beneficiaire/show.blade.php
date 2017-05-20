@extends('layouts.adminlte')

@section('title', 'Fiche bénéficiaire - '. $beneficiaire->nom_complet)

@section('content_header')
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('beneficiaires.edit', $beneficiaire) }}">Modifier</a>
    </div>
    <h1>
        Bénéficiaire - {{$beneficiaire->nomComplet}}
    </h1>
@stop

@section('content')
    {{ Form::model($beneficiaire, ['route' => ['beneficiaires.update', $beneficiaire]]) }}
    @include ('beneficiaire.form', ['submitButtonText' => 'Enregistrer', 'readonly' => true])
    {{ Form::close() }}

@stop