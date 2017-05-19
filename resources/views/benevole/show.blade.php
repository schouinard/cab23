@extends('layouts.adminlte')

@section('title', 'Fiche bénévole - '. $benevole->nom_complet)

@section('content_header')
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('benevoles.edit', $benevole) }}">Modifier</a>
    </div>
    <h1>
        Bénévole - {{$benevole->nomComplet}}
    </h1>
@stop

@section('content')
    {{ Form::model($benevole, ['route' => ['benevoles.update', $benevole]]) }}
    @include ('benevole.form', ['submitButtonText' => 'Enregistrer', 'readonly' => true])
    {{ Form::close() }}

@stop