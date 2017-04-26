@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bénévoles</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="datatable table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Courriel</th>
                            <th>Telephone</th>
                            <th>Quartier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($benevoles as $benevole)
                            <tr>
                                <td>{{ $benevole->id }}</td>
                                <td><a href="{{ $benevole->path() }}">{{ $benevole->nom }}</a></td>
                                <td>{{ $benevole->prenom }}</td>
                                <td>{{ $benevole->email }}</td>
                                <td>{{ $benevole->telephone }}</td>
                                <td>{{ $benevole->quartier }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop