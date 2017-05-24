@extends('print.base')

@section('title', $title)

@section('body')
    <h3 class="text-center">Centre d'action bénévole Aide 23 - Popote Roulante</h3>
    <h4 class="text-center">{{$tournee->nom}}</h4>
    <h5>Signature des conducteurs et kilométrage</h5>
    <table style="margin-bottom:25px">
        <tr>
            <td width="10%">Km:</td>
            <td width="40%" class="border-bottom"></td>
            <td width="10%">Commentaires:</td>
            <td width="40%" class="border-bottom"></td>
        </tr>
        <tr>
            <td>Signature:</td>
            <td class="border-bottom"></td>
            <td></td>
            <td class="border-bottom"></td>
        </tr>
        <tr>
            <td>Signature:</td>
            <td class="border-bottom"></td>
            <td></td>
            <td class="border-bottom"></td>
        </tr>
    </table>

    @foreach($clients as $client)
        <div style="position:relative;"
             @if(in_array($loop->iteration, [3,7,11,15,19,23,27,31,35,39,43]) ) class="page-break" @endif>
            <div style="width:200px; position:absolute">
                <h4 style="margin-top:3px; font-weight:bold;">{{$client->displayNom}}</h4>
                {!! $client->adress->toHTML() !!}
                <br>
                Tel: {{$client->adress->telephone}} <br>
                Tel2: {{$client->adress->telephone2}}
            </div>
            <table class="table-bordered table table-print" style="width:675px; margin-left:200px;font-size:10pt;">
                <thead>
                <tr>
                    <th width="300px">Personne ressource</th>
                    <th width="150px">Tel1</th>
                    <th width="150px">Tel2</th>
                    <th width="150px">Cellulaire</th>
                </tr>
                </thead>
                <tbody>
                @foreach($client->people as $person)
                    <tr>
                        <td>
                            {{$person->nom}} ({{$person->lien}})
                        </td>
                        <td>{{$person->adress->telephone}}</td>
                        <td>{{$person->adress->telephone2}}</td>
                        <td>{{$person->adress->cellulaire}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
@endsection