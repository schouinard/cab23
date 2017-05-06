@extends('layouts.adminlte')

@section('title', 'Fiche bénévole - '. $benevole->nom_complet)

@section('content_header')
    <div class="page-header">
        <h1 class="flex">
            Fiche bénévole - {{ $benevole->nom_complet }}
            @if($benevole->inscription)
                <small class="pull-right">Inscrit {{ $benevole->inscription->diffForHumans() }}</small>
            @endif
        </h1>
    </div>
@stop

@section('content')
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
                            <a href="{{ $service->beneficiaire->path() }}">{{ $service->beneficiaire->nom }}, {{ $service->beneficiaire->prenom }}</a>
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