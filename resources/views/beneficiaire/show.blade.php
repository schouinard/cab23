@extends('layouts.adminlte')

@section('title', 'Fiche bénéficiaire - '. $beneficiaire->nom_complet)

@section('content_header')
    <div class="pull-right">
        @if($beneficiaire->trashed())
            {!! Form::open([
                'method'=>'POST',
                'url' => ['/beneficiaires/' . $beneficiaire->id . '/restore'],
                'style' => 'display:inline'
            ]) !!}
            {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
            [
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'title' => 'Restaurer le bénéficiaire',

            ]) !!}
            {!! Form::close() !!}
        @else
            <a class="btn btn-primary" href="{{ route('beneficiaires.edit', $beneficiaire) }}">Modifier</a>
        @endif
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