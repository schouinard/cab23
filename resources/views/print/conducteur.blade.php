@extends('print.base')

@section('title', $title)

@section('body')
    <h3 class="text-center">Centre d'action bénévole Aide 23 - Popote Roulante</h3>
    <h4 class="text-center">{{$tournee->nom}}</h4>
    <h5>Signature des conducteurs et kilométrage</h5>
    <table class="table table-responsive">
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
             @if(in_array($loop->iteration, [5,8,11,14,17,20,23,26,29,32,35,38,41]) ) class="page-break" @endif>
            <div style="width:200px; position:absolute">
                <h4>{{$client->displayNom}}</h4>
                {!! $client->adress->toHTML() !!}
                <br>
                Tel: {{$client->adress->telephone}} <br>
                Tel2: {{$client->adress->telephone2}}
            </div>
            <table class="table-bordered table table-print" style="width:675px; margin-left:200px;font-size:10pt;">
                <thead>
                <tr>
                    <th width="300px">Personne ressource</th>
                    <th width="125px">Tel1</th>
                    <th width="125px">Tel2</th>
                    <th width="125px">Cellulaire</th>
                </tr>
                </thead>
                <tbody>
                @foreach($client->people as $person)
                    <tr>
                        <td>
                            <div>{{$person->nom}}</div>
                            <div>({{$person->lien}})</div>
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