@extends('layouts.adminlte')

@section('title', 'Fiche organisme - '. $organisme->nom)

@section('content_header')
    <h1>
        Modifier l'organisme - {{$organisme->nom}}
        <div class="pull-right">
            <a href="{{ url('/organismes') }}" title="Back"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Annuler la modification</button></a>
        </div>
    </h1>
@stop

@section('content')
    @if (count($errors))
        <div class="callout callout-danger">
            <h4>Veuillez valider les points suivants avant de continuer.</h4>
            <ul class="error-content">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($organisme, [
                            'method' => 'PATCH',
                            'url' => ['organismes', $organisme->id],
                        ]) !!}

    @include ('organisme.form', ['submitButtonText' => 'Enregistrer'])

    {!! Form::close() !!}

@stop