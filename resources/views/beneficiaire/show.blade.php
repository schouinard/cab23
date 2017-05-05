@extends('layouts.adminlte')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Fiche bénéficiaire - {{ $beneficiaire->prenom }} &nbsp; {{ $beneficiaire->nom }}</h1>
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
            {{ $beneficiaire->telephone }}
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- box-footer -->
    </div><!-- /.box -->
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
                            <a href="{{ $service->benevole->path() }}">{{ $service->benevole->nom }}, {{ $service->benevole->nom }}</a>
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
            <form method="POST" action="{{ $beneficiaire->path() . '/services' }}">

                <table class="table table-bordered">
                    {{ csrf_field() }}
                    {{ Form::hidden('beneficiaire_id', $beneficiaire->id, ['id' => 'beneficiaire_id']) }}
                    {{ Form::hidden('benevole_id', null, ['id' => 'benevole_id']) }}
                    <tr>
                        <td class="{{ $errors->first('service_type_id', 'has-error') }}">
                            {{ Form::select('service_type_id', $serviceTypes->pluck('nom', 'id'),null, ['class' => 'form-control', 'required' => 'required']) }}
                        </td>
                        <td class="{{ $errors->first('benevole_id', 'has-error') }}">
                            {{ Form::text('benevole', null, ['class' => 'form-control autocomplete',
                                'data-model' => 'benevole',
                                'data-display' => 'nom_complet',
                                'placeholder' => 'Bénévole',
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

