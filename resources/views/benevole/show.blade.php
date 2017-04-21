@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ $benevole->prenom }} &nbsp; {{ $benevole->nom }}</h1>
@stop

@section('content')
    {{ $benevole->telephone }}
@stop