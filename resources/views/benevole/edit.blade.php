@extends('layouts.adminlte')

@section('title', 'Modifier bénévole - '. $benevole->nomComplet)

@section('content_header')
    <h1>
        Modifier le bénévole - {{$benevole->nomComplet}}
        <div class="pull-right">
            <a href="{{ url('/benevoles') }}" title="Back"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Annuler la modification</button></a>
        </div>
    </h1>
@stop

@section('content')

    {!! Form::model($benevole, [
                            'method' => 'PATCH',
                            'url' => ['benevoles', $benevole->id],
                        ]) !!}

    @include ('benevole.form', ['submitButtonText' => 'Enregistrer'])

    {!! Form::close() !!}

@stop