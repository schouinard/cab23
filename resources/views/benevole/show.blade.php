@extends('layouts.adminlte')

@section('title', 'Fiche bénévole - '. $benevole->nom_complet)

@section('content_header')
    <div class="page-header">
        <h1>
            Bénévole
        </h1>
    </div>
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Identification</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Sélection</a></li>
            <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">Intérêts</a></li>
            <li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Disponibilités</a></li>
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
                <table class="datatable">
                    <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Priorité</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(array_merge($benevole->interets->toArray(), $benevole->competences->toArray()) as $item)
                        <tr>
                            <td>{{$item->categorieInteretCompetence->nom}}</td>
                            <td>{{$item->nom}}</td>
                            <td>{{class_basename($item)}}</td>
                            <td>{{$item->priority}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Identification</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{ $benevole->telephone }}
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Champs d'intérêt</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div>
        <div class="box-body">
            <h4>Clientèles</h4>
            <ul>
                @foreach($benevole->clienteles as $clientele)
                    <li>{{$clientele->nom}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Services rendus</h3>
            <div class="box-tools pull-right">
                <!-- This will cause the box to collapse when clicked -->
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-hover table-bordered datatable">
                <thead>
                <tr>
                    <td>Type</td>
                    <td>Bénéficiaire</td>
                    <td>Rendu le</td>
                    <td>Don</td>
                </tr>
                </thead>
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
                        <td>{{ $service->don }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            @component("components.addService", ['serviceTypes' => $serviceTypes, 'beneficiaireId' => null, 'benevoleId' => $benevole->id, 'showBenevole' => false, 'showBeneficiaire' =>true])
            @endcomponent
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop