@extends('print.base')

@section('title', $title)

@section('body')
    <h3 class="text-center" style="margin-top:0;">Centre d'action bénévole Aide 23 - Popote Roulante</h3>
    <h4 class="text-center">{{$title}}</h4>
    <div class="text-center">Cellulaire d'urgence: 418-998-8219</div>
    <table class="table table-bordered table-print table-condensed">
        <thead>
        <tr>
            <th colspan="7">{{$tournee->nom}} - Tel: {{$tournee->telephone}}</th>
            <th class="text-right">Semaine du 10-10-2016</th>
        </tr>
        <tr>
            <th width="3%">#</th>
            <th width="30%">Client</th>
            @foreach($tournee->days as $day)
                <th width="8%">{{substr($day->nom, 0,3)}}</th>
            @endforeach
            <th>Commentaires</th>
        </tr>
        </thead>

        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{$client->tournee_priorite}}</td>
                <td>{{$client->displayNom}} ({{$client->anniversaire}})<br>{{$client->adress->adresse}}</td>
                @foreach($tournee->days as $day)
                    <td class="text-center" valign="center">
                        @if(! $client->isPopoteDay($day->id))
                            <i class="fa fa-times" style="font-size:3em; color:#999" aria-hidden="true"></i>
                        @elseif($client->tournee_payee)
                            <div class="text-center vcenter">PAYÉ</div>
                        @endif
                    </td>
                @endforeach
                <td style="font-size:8pt;">{{$client->tournee_note}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"><span class="text-sm text-bold">Porte-monnaie ($)</span></td>
            @foreach($tournee->days as $day)
                <td></td>
            @endforeach
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><span class="text-sm text-bold">Recueilli ($)</span></td>
            @foreach($tournee->days as $day)
                <td></td>
            @endforeach
            <td></td>
        </tr>
        </tfoot>
    </table>
    <h3 class="text-center">Merci d'être là et bonne tournée!</h3>
@endsection