@extends('layouts.adminlte')

@section('title', 'Inscription bénévole')

@section('content_header')
    <h1>Nouveau Bénévole</h1>
@stop

@section('content')
    {!! Form::open(['url' => '/benevoles']) !!}

    @include ('benevole.form')

    {!! Form::close() !!}
@stop