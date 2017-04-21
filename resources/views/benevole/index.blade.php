@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bénévoles</h1>
@stop

@section('content')
    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Courriel</th>
        </tr>
        </thead>
        <tbody>
        @foreach($benevoles as $benevole)
            <tr>
                <td><a href="{{ $benevole->path() }}">{{ $benevole->nom }}</a></td>
                <td>{{ $benevole->prenom }}</td>
                <td>{{ $benevole->email }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
@stop