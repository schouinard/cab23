@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bénévoles</h1>
@stop

@section('content')
    @foreach($benevoles as $benevole)
        <article>
            <a href="{{ $benevole->path() }}">{{ $benevole->prenom }} &nbsp; {{ $benevole->nom }}</a>
        </article>
    @endforeach
@stop