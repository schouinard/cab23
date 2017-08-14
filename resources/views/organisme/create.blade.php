@extends('layouts.adminlte')

@section('title', 'Nouvel Organisme')

@section('content_header')
    <h1>Nouvel organisme</h1>
@stop

@section('content')

    {!! Form::open(['url' => '/organismes']) !!}

    @include ('organisme.form')

    {!! Form::close() !!}
@stop