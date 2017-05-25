@extends('layouts.adminlte')

@section('title', 'Modifier bénéficiaire - '. $beneficiaire->nomComplet)

@section('content_header')
    <h1>
        Modifier le bénéficiaire - {{$beneficiaire->nomComplet}}
        <div class="pull-right">
            <a href="{{ url('/beneficiaires') }}" title="Back"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Annuler la modification</button></a>
        </div>
    </h1>
@stop

@section('content')

    {!! Form::model($beneficiaire, [
                            'method' => 'PATCH',
                            'url' => ['beneficiaires', $beneficiaire->id],
                        ]) !!}

    @include ('beneficiaire.form', ['submitButtonText' => 'Enregistrer'])

    {!! Form::close() !!}

@stop