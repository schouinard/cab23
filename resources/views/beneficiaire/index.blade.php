@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bénéficiaires</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="datatable table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Courriel</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($beneficiaires as $beneficiaire)
                            <tr>
                                <td><a href="{{ $beneficiaire->path() }}">{{ $beneficiaire->nom }}</a></td>
                                <td>{{ $beneficiaire->prenom }}</td>
                                <td>{{ $beneficiaire->email }}</td>
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

