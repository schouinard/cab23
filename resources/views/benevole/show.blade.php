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
            @if (count($errors))
                <div class="callout callout-danger">
                    <h4>Veuillez valider les points suivants avant de continuer.</h4>
                    <ul class="error-content">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ $benevole->path() . '/services' }}">

                <table class="table table-bordered">
                    {{ csrf_field() }}
                    {{ Form::hidden('beneficiaire_id', null , ['id' => 'beneficiaire_id']) }}
                    {{ Form::hidden('benevole_id', $benevole->id, ['id' => 'benevole_id']) }}
                    <tr>
                        <td class="{{ $errors->first('service_type_id', 'has-error') }}">
                            {{ Form::select('service_type_id', $serviceTypes->pluck('nom', 'id'),null, ['class' => 'form-control', 'required' => 'required']) }}
                        </td>
                        <td class="{{ $errors->first('beneficiaire_id', 'has-error') }}">{{ Form::text('beneficiaire', null, ['class' => 'form-control autocomplete',
                                'data-model' => 'beneficiaire',
                                'data-display' => 'nom_complet',
                                'placeholder' => 'Bénéficiaire',
                                'required' => 'required',
                                ]) }}
                        </td>
                        <td>
                            <div class="input-group date datepicker {{ $errors->first('rendu_le', 'has-error') }}">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {{Form::text('rendu_le', Carbon\Carbon::today()->toDateString(), ['class' => 'form-control pull-right', 'required' => 'required'])}}
                            </div>
                        </td>
                        <td class="{{ $errors->first('don', 'has-error') }}">
                            {{ Form::text('don', null, ['class' => 'form-control']) }}
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </td>
                    </tr>
                </table>
            </form>

        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop