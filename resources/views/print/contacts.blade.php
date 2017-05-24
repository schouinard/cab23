@extends('print.base')

@section('title', $title)

@section('body')
    <h3 class="text-center">Centre d'action bénévole Aide 23 - Popote Roulante</h3>
    <h5>Signature des conducteurs et kilométrage</h5>
    <div style="margin-bottom:25px" class="row">
        <div class="col-xs-6">
            <div class="border-bottom">
                Commentaires:
            </div>
            <div class="border-bottom">&nbsp;</div>
            <div class="border-bottom">&nbsp;</div>
            <div class="border-bottom">&nbsp;</div>
            <div class="border-bottom">&nbsp;</div>
        </div>
        <div class="col-xs-6">
            @foreach($tournee->days as $day)
                <div class="border-bottom">{{$day->nom}}:</div>
            @endforeach
        </div>
    </div>
    <table class="table table-responsive table-print">
        <thead>
        <tr>
            <th>{{$tournee->nom}}</th>
        </tr>
        <tr>
            <th>Bénéficiaires</th>
            <th>Téléphone</th>
            <th>Personne-ressource</th>
            <th>Tel</th>
            <th>Tel2</th>
            <th>Cellulaire</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{$client->displayNom}}</td>
                <td>{{$client->adress->telephone}}</td>
                <td>{{$client->people->first()->nom}} ({{$client->people->first()->lien}})</td>
                <td>{{$client->people->first()->adress->telephone}}</td>
                <td>{{$client->people->first()->adress->telephone2}}</td>
                <td>{{$client->people->first()->adress->cellulaire}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection