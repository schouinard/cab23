@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bénéficiaire</h1>
@stop

@section('content')
    <div class="nav-tabs-custom">
        @include('beneficiaire.partials.tabs')
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <h3>
                    {{$beneficiaire->nom_complet}}
                </h3>
                <ul>
                    <li><strong>Conjoint:</strong> {{$beneficiaire->conjoint}}</li>
                    <li><strong>Date de naissance:</strong> {{$beneficiaire->naissance->format('Y-m-d')}}</li>
                </ul>
                <h3>
                    Adresse:
                </h3>
                <div>
                    {{$beneficiaire->adress->adresse }}<br>
                    {{$beneficiaire->adress->secteur->nom}}<br>
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
                    @foreach($beneficiaire->etats_sante as $item)
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
                    <li><strong>Source de revenu:</strong> {{$beneficiaire->income_source->nom}}
                        @if($beneficiaire->income_source_id == 3)
                            ({{$beneficiaire->securite_sociale}})
                        @elseif($beneficiaire->income_source_id == 4)
                            ({{$beneficiaire->curateur_public}})
                        @elseif($beneficiaire->income_soucre_id==6)
                            ({{$beneficiaire->autre}})
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
                <h3>Personne ressource 1</h3>

            </div>
            <div class="tab-pane" id="tab_5">

            </div>
            <div class="tab-pane" id="tab_6">
                <h3>Adresse de facturation</h3>
                <div class="row">
                    <!--- facturation_adresse form input ---->
                    <div class="form-group col-md-12 {{ $errors->first('facturation_adresse', 'has-error') }}">
                        {{ Form::label('facturation_adresse', 'Adresse:') }}
                        {{ Form::text('facturation_adresse', null, ['class' => 'form-control']) }}
                    </div>
                    <!--- facturation_ville form input ---->
                    <div class="form-group col-md-4 {{ $errors->first('facturation_ville', 'has-error') }}">
                        {{ Form::label('facturation_ville', 'Ville:') }}
                        {{ Form::text('facturation_ville', 'Québec', ['class' => 'form-control']) }}
                    </div>

                    <!--- facturation_province form input ---->
                    <div class="form-group col-md-4 {{ $errors->first('facturation_province', 'has-error') }}">
                        {{ Form::label('facturation_province', 'Province:') }}
                        {{ Form::text('facturation_province', 'QC', ['class' => 'form-control']) }}
                    </div>
                    <!--- facturation_code_postal form input ---->
                    <div class="form-group col-md-4 {{ $errors->first('facturation_code_postal', 'has-error') }}">
                        {{ Form::label('facturation_code_postal', 'Code postal:') }}
                        {{ Form::text('facturation_code_postal', null, ['class' => 'form-control codepostal']) }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Services reçus</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-hover datatable">
                <thead>
                <tr>
                    <td>Type</td>
                    <td>Bénévole</td>
                    <td>Rendu le</td>
                    <td>Don</td>
                </tr>
                </thead>
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
        </div><!-- /.box-body -->
        <div class="box-footer">
            @component("components.addService", ['serviceTypes' => $serviceTypes, 'beneficiaireId' => $beneficiaire->id, 'benevoleId' => null, 'showBenevole' => true, 'showBeneficiaire' =>false])
            @endcomponent

        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop

