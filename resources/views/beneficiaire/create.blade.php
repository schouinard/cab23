@extends('layouts.adminlte')

@section('title', 'Inscription bénéficiaire')

@section('content_header')
    <h1>Nouveau Bénéficiaire</h1>
@stop

@section('content')

    {!! Form::open(['url' => '/beneficiaires']) !!}

    @include ('beneficiaire.form')

    {!! Form::close() !!}
@stop