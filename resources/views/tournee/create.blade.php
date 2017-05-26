@extends('layouts.adminlte')

@section('title', "Ajouter une tournée de popote")

@section('content_header')
    <h1>Nouvelle tournée</h1>
@stop

@section('content')

    {!! Form::open( [
                               'method' => 'POST',
                               'route' => 'tournees.store',
                           ]) !!}
    @include('tournee.form')
    {{Form::close()}}
@endsection