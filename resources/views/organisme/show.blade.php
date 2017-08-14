@extends('layouts.adminlte')

@section('title', 'Fiche organisme - '. $organisme->nom)

@section('content_header')
    <div class="pull-right">
        @if($organisme->trashed())
            {!! Form::open([
                'method'=>'POST',
                'url' => ['/organismes/' . $organisme->id . '/restore'],
                'style' => 'display:inline'
            ]) !!}
            {!! Form::button('<i class="fa fa-undo" aria-hidden="true"></i> Restaurer',
            [
                    'type' => 'submit',
                    'class' => 'btn btn-success',
                    'title' => 'Restaurer l\'organisme',

            ]) !!}
            {!! Form::close() !!}
        @else
            <a class="btn btn-primary" href="{{ route('organismes.edit', $organisme) }}">Modifier</a>
        @endif
    </div>
    <h1>
        Organisme - {{$organisme->nom}}
    </h1>
@stop

@section('content')
    {{ Form::model($organisme, ['route' => ['organismes.update', $organisme]]) }}
    @include ('organisme.form', ['submitButtonText' => 'Enregistrer', 'readonly' => true])
    {{ Form::close() }}

@stop