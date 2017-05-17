@extends('layouts.adminlte')

@section('title', "Fiche bénéficiaire - {$beneficiaire->nom_complet}")

@section('content_header')
        <h1>Bénéficiaire</h1>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">État de santé</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Statut</a></li>
            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Personnes ressources</a></li>
            <li><a href="#tab_5" data-toggle="tab" aria-expanded="false">Services</a></li>
            <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Facturation</a></li>
            <li><a href="#tab_7" data-toggle="tab" aria-expanded="false">Notes</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <h3>
                    {{$beneficiaire->nom_complet}}
                </h3>
                <ul>
                    <li><strong>Conjoint:</strong> {{$beneficiaire->conjoint}}</li>
                    <li><strong>Date de
                            naissance:</strong> @if($beneficiaire->naissance){{$beneficiaire->naissance->format('Y-m-d')}}@endif
                    </li>
                </ul>
                <h3>
                    Adresse:
                </h3>
                <div>
                    {{$beneficiaire->adress->adresse }}<br>
                    @if($beneficiaire->adress->secteur){{$beneficiaire->adress->secteur->nom}}<br>@endif
                    {{$beneficiaire->adress->ville}}, {{$beneficiaire->adress->province}}<br>
                    {{$beneficiaire->adress->code_postal}}
                </div>
                <h3>Contacts:</h3>
                <ul>
                    <li><strong>Téléphone:</strong> {{$beneficiaire->adress->telephone}}</li>
                    <li><strong>Autre tél:</strong> {{$beneficiaire->adress->telephone2}}</li>
                    <li><strong>Cellulaire:</strong> {{$beneficiaire->adress->cellulaire}}</li>
                    <li><strong>Courriel:</strong> {{$beneficiaire->adress->email}}</li>
                </ul>
                <h3>Remarques:</h3>
                <div>
                    {{$beneficiaire->remarque}}
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <h3>État de santé</h3>
                <ul>
                    @foreach($beneficiaire->etatsSante as $item)
                        <li>{{$item->nom}}</li>
                    @endforeach
                </ul>
                <div>
                    {{$beneficiaire->etat_sante_autre}}
                </div>
                <h3>Autonomie</h3>
                <ul>
                    @foreach($beneficiaire->autonomies as $item)
                        <li>{{$item->nom}}</li>
                    @endforeach
                </ul>
                <div>
                    {{$beneficiaire->autonomie_autre }}
                </div>
                <h3>Support familial</h3>
                <div>
                    {{$beneficiaire->support_familial}}ben
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <ul>
                    <li><strong>Résidence:</strong> {{$beneficiaire->residence}}</li>
                    <li><strong>Occupation:</strong> {{$beneficiaire->occupation}}</li>
                    <li><strong>Évaluation à domicile:</strong> {{$beneficiaire->evaluation_domicile}}</li>
                    <li><strong>Date de la première demande:</strong> {{$beneficiaire->premiere_demande}}</li>
                    <li><strong>Source de revenu:</strong>
                        @if($beneficiaire->income_source)
                            {{$beneficiaire->income_source->nom}}
                            @if($beneficiaire->income_source_id == 3)
                                ({{$beneficiaire->securite_sociale}})
                            @elseif($beneficiaire->income_source_id == 4)
                                ({{$beneficiaire->curateur_public}})
                            @elseif($beneficiaire->income_soucre_id==6)
                                ({{$beneficiaire->autre}})
                            @endif
                        @endif
                    </li>
                </ul>
                <ul>
                    <li><strong>Contribution
                            volontaire: </strong>{{$beneficiaire->contribution_volontaire ? 'Oui' : 'Non'}}</li>
                    <li><strong>Attestation de visite
                            médicale: </strong>{{$beneficiaire->visite_medicale ? 'Oui' : 'Non'}}</li>
                    <li><strong>Gratuité: </strong>{{$beneficiaire->gratuite ? 'Oui' : 'Non'}}</li>
                    <li><strong>Accepte d'être sollicité dans le cadre d'une campagne de
                            financement: </strong>{{$beneficiaire->accepte_sollicitation ? 'Oui' : 'Non'}}</li>
                </ul>

            </div>
            <div class="tab-pane" id="tab_4">
                @foreach($beneficiaire->people as $person)
                    <h3>{{$person->lien}}: {{$person->nom}}</h3>
                    <h3>Adresse</h3>
                    <div>
                        {{$beneficiaire->adress->adresse }}<br>
                        @if($beneficiaire->adress->secteur){{$beneficiaire->adress->secteur->nom}}<br>@endif
                        {{$beneficiaire->adress->ville}}, {{$beneficiaire->adress->province}}<br>
                        {{$beneficiaire->adress->code_postal}}
                    </div>
                    <h3>Contacts:</h3>
                    <ul>
                        <li><strong>Téléphone:</strong> {{$beneficiaire->adress->telephone}}</li>
                        <li><strong>Autre tél:</strong> {{$beneficiaire->adress->telephone2}}</li>
                        <li><strong>Cellulaire:</strong> {{$beneficiaire->adress->cellulaire}}</li>
                        <li><strong>Courriel:</strong> {{$beneficiaire->adress->email}}</li>
                    </ul>
                    <hr>
                @endforeach

            </div>
            <div class="tab-pane" id="tab_5">
                <h3>Services demandés</h3>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            @foreach($beneficiaire->serviceRequests as $serviceRequest)
                                <li>{{$serviceRequest->nom}}
                                    <strong>({{$serviceRequestStatuses[$serviceRequest->pivot->service_request_status_id]->nom}}
                                        )</strong></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <h3>Services reçus</h3>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover services-donne" width="100%">
                            <thead>
                            <tr>
                                <td>Type</td>
                                <td>Bénévole</td>
                                <td>Rendu le</td>
                                <td>Don</td>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th colspan="3" style="text-align:right">Total:</th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($beneficiaire->services as $service)
                                <tr>
                                    <td>
                                        {{ $service->type->nom }}
                                    </td>
                                    <td>
                                        <a href="{{ $service->benevole->path() }}">{{ $service->benevole->nom }}
                                            , {{ $service->benevole->prenom }}</a>
                                    </td>
                                    <td>
                                        {{ $service->rendu_le }}
                                    </td>
                                    <td>
                                        {{ $service->don }}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <h3>Ajouter un service reçu</h3>
                <div class="row">
                    <div class="col-md-12">
                        @component("components.addService", ['serviceTypes' => $serviceTypes, 'beneficiaireId' => $beneficiaire->id, 'benevoleId' => null, 'showBenevole' => true, 'showBeneficiaire' =>false])
                        @endcomponent
                    </div><!-- box-footer -->
                </div>
            </div>
            <div class="tab-pane" id="tab_6">
                <h3>Adresse de facturation</h3>
                <div>
                    {{$beneficiaire->facturation_nom}}<br>
                    {{$beneficiaire->facturation->adresse }}<br>
                    @if($beneficiaire->facturation->secteur){{$beneficiaire->facturation->secteur->nom}}<br>@endif
                    {{$beneficiaire->facturation->ville}}, {{$beneficiaire->facturation->province}}<br>
                    {{$beneficiaire->facturation->code_postal}}
                </div>
                <h3>Contacts:</h3>
                <ul>
                    <li><strong>Téléphone:</strong> {{$beneficiaire->facturation->telephone}}</li>
                    <li><strong>Autre tél:</strong> {{$beneficiaire->facturation->telephone2}}</li>
                    <li><strong>Cellulaire:</strong> {{$beneficiaire->facturation->cellulaire}}</li>
                    <li><strong>Courriel:</strong> {{$beneficiaire->facturation->email}}</li>
                </ul>
            </div>
            <div class="tab-pane" id="tab_7">
                @foreach($beneficiaire->notes as $note)
                    @include('partials.show.notes', ['note' => $note])
                @endforeach
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
@stop

