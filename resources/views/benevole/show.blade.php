@extends('layouts.adminlte')

@section('title', 'Fiche bénévole - '. $benevole->nom_complet)

@section('content_header')
    <div class="pull-right">
        @if($benevole->trashed())
            {!! Form::open([
                'method'=>'POST',
                'url' => ['/benevoles/' . $benevole->id . '/restore'],
                'style' => 'display:inline'
            ]) !!}
            {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
            [
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'title' => 'Restaurer le bénévole',

            ]) !!}
            {!! Form::close() !!}
        @else
            <a class="btn btn-primary" href="{{ route('benevoles.edit', $benevole) }}">Modifier</a>
        @endif
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