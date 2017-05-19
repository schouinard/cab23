@extends('layouts.adminlte')

@section('title', 'Nouvel Organisme')

@section('content_header')
    <h1>Nouvel organisme</h1>
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
    {!! Form::open(['url' => '/organismes']) !!}

    @include ('organisme.form')

    {!! Form::close() !!}
@stop