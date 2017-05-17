@extends('layouts.adminlte')

@section('title', 'Fiche bénévole - '. $benevole->nom_complet)

@section('content_header')
    <h1>
        Bénévole
    </h1>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Sélection</a></li>
            <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">Intérêts</a></li>
            <li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Disponibilités</a></li>
            <li><a href="#tab_5" data-toggle="tab" aria-expanded="false">Services</a></li>
            <li><a href="#tab_6" data-toggle="tab" aria-expanded="false">Notes</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <h3>{{$benevole->nom_complet}} <span class="small">({{$benevole->benevoleType->nom}})</span></h3>
                <ul>
                    <li><strong>Date de
                            naissance:</strong> @if($benevole->naissance){{$benevole->naissance->format('Y-m-d')}}@endif
                    </li>
                </ul>
                <h3>
                    Adresse:
                </h3>
                <div>
                    {{$benevole->adress->adresse }}<br>
                    @if($benevole->adress->secteur){{$benevole->adress->secteur->nom}}<br>@endif
                    {{$benevole->adress->ville}}, {{$benevole->adress->province}}<br>
                    {{$benevole->adress->code_postal}}
                </div>
                <h3>Contacts:</h3>
                <ul>
                    <li><strong>Téléphone:</strong> {{$benevole->adress->telephone}}</li>
                    <li><strong>Autre tél:</strong> {{$benevole->adress->telephone2}}</li>
                    <li><strong>Cellulaire:</strong> {{$benevole->adress->cellulaire}}</li>
                    <li><strong>Courriel:</strong> {{$benevole->adress->email}}</li>
                </ul>
                <h3>Remarques:</h3>
                <div>
                    {{$benevole->remarque}}
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                <h3>Antécédents judiciaires</h3>
                {{ $benevole->antecedents }}
                <h3>Enquête sociale</h3>
                {{$benevole->enquete_sociale}}
                <h3>Dates de suivis</h3>
                <ul>
                    <li><strong>Inscription:</strong> {{$benevole->inscription}}</li>
                    <li><strong>Intégration:</strong> {{$benevole->integration}}</li>
                    <li><strong>Suivi:</strong> {{$benevole->suivi}}</li>
                    <li><strong>Accepté au CA:</strong> {{$benevole->accepte_ca}}</li>
                </ul>
            </div>
            <div class="tab-pane" id="tab_3">
                <h3>Clientèles</h3>
                <ul>
                    @foreach($benevole->clienteles as $clientele)
                        <li>{{$clientele->nom}}</li>
                    @endforeach
                </ul>
                <h3>Intérêts et compétences</h3>
                <table class="table table-hover table-bordered datatable" width="100%">
                    <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Priorité</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($benevole->interets as $item)
                        <tr>
                            <td>{{$item->category->nom}}</td>
                            <td>{{$item->nom}}</td>
                            <td>{{class_basename($item)}}</td>
                            <td>{{$item->pivot->priority}}</td>
                        </tr>
                    @endforeach
                    @foreach($benevole->competences as $item)
                        <tr>
                            <td>{{$item->category->nom}}</td>
                            <td>{{$item->nom}}</td>
                            <td>{{class_basename($item)}}</td>
                            <td>{{$item->pivot->priority}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab_4">

                @foreach($days as $day)
                    <div class="row">
                        <div class="col-md-2">
                            {{$day->nom}}
                        </div>
                        <div class="col-md-2">
                            {{ count($benevole->disponibilites->where('day_id', $day->id)) ? $benevole->disponibilites->where('day_id', $day->id)->pluck(['moment'])->pluck('nom')->implode(', ') : "Indisponible" }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tab-pane" id="tab_5">
                <h3>Services aux bénéficiaires</h3>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover services-donne" width="100%">
                            <thead>
                            <tr>
                                <td>Type</td>
                                <td>Bénévole</td>
                                <td>Rendu le</td>
                                <td>Heures</td>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total:</th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($benevole->services as $service)
                                <tr>
                                    <td>
                                        {{ $service->type->nom }}
                                    </td>
                                    <td>
                                        <a href="{{ $service->beneficiaire->path() }}">{{ $service->beneficiaire->nom }}
                                            , {{ $service->beneficiaire->prenom }}</a>
                                    </td>
                                    <td>
                                        {{ $service->rendu_le }}
                                    </td>
                                    <td>
                                        {{$service->heures}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <h3>Ajouter un service bénéficiaire</h3>
                <div class="row">
                    <div class="col-md-12">
                        @component("components.addService", ['serviceTypes' => $serviceTypes, 'beneficiaireId' => null, 'benevoleId' => $benevole->id, 'showBenevole' => false, 'showBeneficiaire' =>true])
                        @endcomponent
                    </div><!-- box-footer -->
                </div>
            </div>
            <div class="tab-pane" id="tab_6">
                @foreach($benevole->notes as $note)
                    @include('partials.show.notes', ['note' => $note])
                @endforeach
            </div>
        </div>

    </div><!-- /.box -->
@stop